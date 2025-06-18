<?php

namespace App\View\Components\Sections;

use App\Models\ParametreSessionJoueur;
use App\Models\SessionJoueur;
use App\Models\Simulation as ModelsSimulation;
use Livewire\Component;
use MathPHP\Probability\Distribution\Continuous\Normal;

class Simulation extends Component
{
    public $joinedPlayer;
    public $simulation;
    public $PlayerParameters;
    public $manufactured, $scrapped, $sold, $stock;
    public $breakdown_events, $total_breakdown_minutes, $total_CO2, $new_cash;
    public $cyber_attacks_total, $cyber_attacks_success, $total_cyberattack_minutes;
    public $cash;
    
    public function mount($sessionId, $playerId, $simulationId)
    {
        $this->joinedPlayer = SessionJoueur::where('id_session',$sessionId)
            ->where('id_player',$playerId)
            ->firstOrFail();

        $this->simulation = ModelsSimulation::where('id', $simulationId)->firstOrFail();

        $this->PlayerParameters = ParametreSessionJoueur::where('session_joueur_id', $this->joinedPlayer->id)
            ->with('parametre')
            ->get()
            ->keyBy(fn($param) => $param->parametre->nom);
    }

    public function Simulate($sim_days, $sim_hours_per_day)
    {
        /*
        Simule le système de production sur une période donnée.

        Arguments:
        player_params      : Instance de PlayerParameters avec les paramètres initiaux.
        sim_days           : Nombre de jours à simuler.
        sim_hours_per_day  : Nombre d'heures de production par jour.

        Retourne l'instance player_params mise à jour avec les résultats simulés. 
        */

        // Calcul du temps total de simulation en heures
        $PlayerParameters = $this->PlayerParameters;
        $total_hours = $sim_days * $sim_hours_per_day;

        // ---------------------------- Pannes ----------------------------
        // Simulation du nombre de pannes avec une loi de Poisson
        $lam = $PlayerParameters['breakdown_rate']->valeur * $total_hours;
        //$poisson = new Poisson($lam);
        $breakdown_events = $this->poissonSample($lam);
        $this->breakdown_events = $breakdown_events;
        $total_breakdown_minutes = 0;

        if ($breakdown_events > 0) {
            $normal = new Normal($PlayerParameters['average_downtime']->valeur, 2);
            for ($i = 0; $i < $breakdown_events; $i++) {
                $duration = max(0, $normal->rand());
                $total_breakdown_minutes += $duration;
            }
        }
        $this->total_breakdown_minutes = $total_breakdown_minutes;

        
        // ---------------------------- Cyberattaques ----------------------------
        // Conversion de la durée simulée en mois (30 jours par mois)
        $sim_months = $sim_days / 30.0;

        $expected_cyber_attacks = $PlayerParameters['attack_frequency']->valeur * $sim_months;
        $cyber_attacks_total = $this->poissonSample($expected_cyber_attacks);
        $this->cyber_attacks_total = $cyber_attacks_total;

        $cyber_attacks_success = 0;
        $total_cyberattack_minutes = 0.0;

        for ($i = 0; $i < $cyber_attacks_total; $i++) {
            $rand = mt_rand() / mt_getrandmax();
            if ($rand < $PlayerParameters['attack_success_rate']->valeur / 100) {
                $cyber_attacks_success++;
                $total_cyberattack_minutes += $PlayerParameters['attack_downtime']->valeur;
            }
        }
        $this->cyber_attacks_success = $cyber_attacks_success;
        $this->total_cyberattack_minutes = $total_cyberattack_minutes;
        // Downtime total (pannes + cyberattack ) en heures
        $breakdown_downtime_hours = $total_breakdown_minutes / 60.0;
        $cyberattack_downtime_hours = $total_cyberattack_minutes / 60.0;

        // ---------------------------- Production effective ----------------------------
        $effective_hours = max($total_hours - $breakdown_downtime_hours - $cyberattack_downtime_hours, 0);
        if ($cyber_attacks_success > 0){
            $effective_production_rate = $PlayerParameters['production_rate']->valeur * (1 -  $PlayerParameters['attack_impact_on_production']->valeur / 100);
        }else{
            $effective_production_rate = $PlayerParameters['production_rate']->valeur;
        }

        $produced = $effective_hours * $effective_production_rate;
        $manufactured = (int) $produced;
        $this->manufactured = $manufactured;

        # ---------------------------- Rebus et ventes ----------------------------
        if ($manufactured > 0) {
            $scrapped = $this->binomial_sample($manufactured, $PlayerParameters['scrap_rate']->valeur / 100.0);
        } else {
            $scrapped = 0;
        }
        $this->scrapped = $scrapped;
        
        $available_for_sale = $manufactured - $scrapped;
        if ($available_for_sale > 0) {
            $sold = $this->binomial_sample($available_for_sale, $PlayerParameters['sales_rate']->valeur / 100.0);
        } else {
            $sold = 0;
        }
        $this->sold = $sold;
        $stock = $available_for_sale - $sold;
        $this->stock = $stock;

        // ---------------------------- Mise à jour du cash ----------------------------
        $revenue = $sold * $PlayerParameters['product_price']->valeur;
        $cost_raw_material = $manufactured * $PlayerParameters['raw_material_cost']->valeur;
        $non_quality_cost = $scrapped * $PlayerParameters['cost_of_non_quality']->valeur;
        $storage_cost_total = $stock * $PlayerParameters['storage_cost']->valeur * $sim_months;

        $this->cash = (
            $PlayerParameters['cash']->valeur
            + $revenue
            - $cost_raw_material
            - $PlayerParameters['cost_of_labor']->valeur
            - $PlayerParameters['maintenance_cost']->valeur
            - $storage_cost_total
            - $non_quality_cost
        );
        $this->dispatch('scoreUpdated');
        // ---------------------------- Émissions de CO2 ----------------------------
        $max_possible_production = $total_hours * $PlayerParameters['production_rate']->valeur;

        if ($max_possible_production > 0) {
            $emission_per_product = $PlayerParameters['CO2_emission']->valeur / $max_possible_production;
        } else {
            $emission_per_product = 0;
        }
        $total_CO2 = $manufactured * $emission_per_product;
        $this->total_CO2 = $total_CO2;

        // ---------------------------- Mise à jour des paramètres de session du joueur ----------------------------
        $this->PlayerParameters->each(function ($param) use ($manufactured, $scrapped, $sold, $stock, $breakdown_events, $total_breakdown_minutes, $total_CO2,$cyber_attacks_total, $cyber_attacks_success, $total_cyberattack_minutes) {
            switch ($param->parametre->nom) {
                case 'products_manufactured':
                    $param->valeur = $manufactured;
                    break;
                case 'products_scrapped':
                    $param->valeur = $scrapped;
                    break;
                case 'products_sold':
                    $param->valeur = $sold;
                    break;
                case 'products_stock':
                    $param->valeur = $stock;
                    break;
                case 'breakdowns':
                    $param->valeur = $breakdown_events;
                    break;
                case 'total_breakdown_duration':
                    $param->valeur = $total_breakdown_minutes;
                    break;
                case 'total_CO2':
                    $param->valeur = $total_CO2;
                    break;
                case 'cash':
                    $param->valeur = $this->cash;
                    break;
                case 'cyberattacks_total':
                    $param->valeur = $cyber_attacks_total;
                    break;
                case 'cyberattacks_success':
                    $param->valeur = $cyber_attacks_success;
                    break;
                case 'cyberattack_downtime':
                    $param->valeur = $total_cyberattack_minutes;
                    break;
                
                default:
                    // Pas de mise à jour pour d'autres paramètres
                    break;
            }
            $param->save();
        });
    }


    private function poissonSample($lambda)
    {
        $L = exp(-$lambda);
        $k = 0;
        $p = 1.0;

        do {
            $k++;
            $p *= mt_rand() / mt_getrandmax();
        } while ($p > $L);

        return $k - 1;
    }

    function binomial_sample($n, $p) {
        $successes = 0;
        for ($i = 0; $i < $n; $i++) {
            if ((mt_rand() / mt_getrandmax()) < $p) {
                $successes++;
            }
        }
        return $successes;
    }

    public function render()
    {
        return view('components.sections.simulation');
    }
}
