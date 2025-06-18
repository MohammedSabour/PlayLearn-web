<?php

namespace Database\Seeders;

use App\Models\Jeu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\QuestionType;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jeu = Jeu::create([
            'titre' => 'Digital Factory Challenge',
            'description' => 'Compete to achieve maximum efficiency and maximize profits in a manufacturing environment.',
        ]);

        // Paramètres
        $jeu->parametres()->createMany([
            ['nom' => 'cash', 'valeur_initiale' => 10000, 'unite' => '€'],
            ['nom' => 'production_rate', 'valeur_initiale' => 50, 'unite' => 'Produits/heure'],
            ['nom' => 'product_price', 'valeur_initiale' => 200, 'unite' => '€'],
            ['nom' => 'breakdown_rate', 'valeur_initiale' => 0.05, 'unite' => 'Pannes/heure'],
            ['nom' => 'average_downtime', 'valeur_initiale' => 15, 'unite' => 'Minutes'],
            ['nom' => 'scrap_rate', 'valeur_initiale' => 5, 'unite' => '%'],
            ['nom' => 'sales_rate', 'valeur_initiale' => 80, 'unite' => '%'],
            ['nom' => 'raw_material_cost', 'valeur_initiale' => 30, 'unite' => '€'],
            ['nom' => 'cost_of_labor', 'valeur_initiale' => 1200, 'unite' => '€'],
            ['nom' => 'safety_stock', 'valeur_initiale' => 100, 'unite' => 'Produits'],
            ['nom' => 'storage_cost', 'valeur_initiale' => 2, 'unite' => '€/produit/mois'],
            ['nom' => 'cost_of_non_quality', 'valeur_initiale' => 10, 'unite' => '€'],
            ['nom' => 'CO2_emission', 'valeur_initiale' => 1500, 'unite' => 'gCO2/cycle'],
            ['nom' => 'maintenance_cost', 'valeur_initiale' => 300, 'unite' => '€'],
            // CyberRiskParameters
            ['nom' => 'attack_frequency', 'valeur_initiale' => 2, 'unite' => 'Attacks/months'],
            ['nom' => 'attack_success_rate', 'valeur_initiale' => 2.30, 'unite' => '%'],
            ['nom' => 'attack_impact_on_production', 'valeur_initiale' => 80, 'unite' => '%'],
            ['nom' => 'attack_downtime', 'valeur_initiale' => 60, 'unite' => 'Minutes'],
            // Champs de sortie de la simulation (initialisés à zéro)
            ['nom' => 'products_manufactured', 'valeur_initiale' => 0, 'unite' => 'Produits'],
            ['nom' => 'products_sold', 'valeur_initiale' => 0, 'unite' => 'Produits'],
            ['nom' => 'products_stock', 'valeur_initiale' => 0, 'unite' => 'Produits'],
            ['nom' => 'products_scrapped', 'valeur_initiale' => 0, 'unite' => 'Produits'],
            ['nom' => 'breakdowns', 'valeur_initiale' => 0, 'unite' => 'Occurrences'],
            ['nom' => 'total_breakdown_duration', 'valeur_initiale' => 0.0, 'unite' => 'Minutes'],
            ['nom' => 'total_CO2', 'valeur_initiale' => 0.0, 'unite' => 'gCO2'],
            ['nom' => 'cyberattacks_total', 'valeur_initiale' => 0.0, 'unite' => 'Attacks'],
            ['nom' => 'cyberattacks_success', 'valeur_initiale' => 0.0, 'unite' => 'Attacks'],
            ['nom' => 'cyberattack_downtime', 'valeur_initiale' => 0.0, 'unite' => 'Minutes'],
        ]);        

        $parametreCash = $jeu->parametres()->where('nom', 'cash')->first();

        $quiz = $jeu->quiz()->create([
            'titre' => 'Knowledge Test',
            'description' => 'Testez vos connaissances avec ce quiz interactif.',
            'id_parametre' => $parametreCash->id,
        ]);

        
        // Question 1 — QCU
        $question1 = $quiz->questions()->create([
            'type' => QuestionType::QCU,
            'question_text' => 'Which technology is at the core of Industry 4.0?',
            'time' => 30,
        ]);

        $question1->choices()->createMany([
            ['choice_text' => 'Steam engine', 'is_correct' => false, 'variation' => -300],
            ['choice_text' => 'Artificial intelligence', 'is_correct' => true, 'variation' => 1200],
            ['choice_text' => 'Nuclear energy', 'is_correct' => false, 'variation' => -300],
            ['choice_text' => 'Coal', 'is_correct' => false, 'variation' => -300],
        ]);

        // Question 2 — QCM
        $question2 = $quiz->questions()->create([
            'type' => QuestionType::QCM,
            'question_text' => 'Which actions help reduce non-quality-related costs?',
            'time' => 40,
        ]);

        $question2->choices()->createMany([
            ['choice_text' => 'Implementing defect detection systems', 'is_correct' => true, 'variation' => 800],
            ['choice_text' => 'Reducing quality control', 'is_correct' => false, 'variation' => -500],
            ['choice_text' => 'Training operators', 'is_correct' => true, 'variation' => 700],
            ['choice_text' => 'Improving production processes', 'is_correct' => true, 'variation' => 600],
        ]);

        // Question 3 — QCU
        $question3 = $quiz->questions()->create([
            'type' => QuestionType::QCU,
            'question_text' => 'What is the main objective of preventive maintenance?',
            'time' => 30,
        ]);

        $question3->choices()->createMany([
            ['choice_text' => 'Wait for machines to break down', 'is_correct' => false, 'variation' => -400],
            ['choice_text' => 'Reduce production rate', 'is_correct' => false, 'variation' => -400],
            ['choice_text' => 'Reduce unexpected downtime', 'is_correct' => true, 'variation' => 1000],
            ['choice_text' => 'Increase production speed', 'is_correct' => false, 'variation' => -200],
        ]);

        // Question 4 — QCM
        $question4 = $quiz->questions()->create([
            'type' => QuestionType::QCM,
            'question_text' => 'Which parameters directly affect storage costs?',
            'time' => 40,
        ]);

        $question4->choices()->createMany([
            ['choice_text' => 'Safety stock level', 'is_correct' => true, 'variation' => 500],
            ['choice_text' => 'CO₂ emission rate', 'is_correct' => false, 'variation' => -200],
            ['choice_text' => 'Unit storage cost', 'is_correct' => true, 'variation' => 600],
            ['choice_text' => 'Inventory turnover', 'is_correct' => true, 'variation' => 700],
        ]);

        // Question 5 — QCU
        $question5 = $quiz->questions()->create([
            'type' => QuestionType::QCU,
            'question_text' => 'What is a consequence of a high scrap rate?',
            'time' => 30,
        ]);

        $question5->choices()->createMany([
            ['choice_text' => 'Improved product quality', 'is_correct' => false, 'variation' => -400],
            ['choice_text' => 'Increased non-quality costs', 'is_correct' => true, 'variation' => -1000],
            ['choice_text' => 'Reduced maintenance needs', 'is_correct' => false, 'variation' => -300],
            ['choice_text' => 'Lower CO₂ emissions', 'is_correct' => false, 'variation' => -200],
        ]);

        // Question 6 — QCM
        $question6 = $quiz->questions()->create([
            'type' => QuestionType::QCM,
            'question_text' => 'Which of the following improve ecological reputation (eco_reputation)?',
            'time' => 40,
        ]);

        $question6->choices()->createMany([
            ['choice_text' => 'Using renewable energy', 'is_correct' => true, 'variation' => 800],
            ['choice_text' => 'Investing in polluting equipment', 'is_correct' => false, 'variation' => -900],
            ['choice_text' => 'Reducing CO₂ emissions', 'is_correct' => true, 'variation' => 700],
            ['choice_text' => 'Optimizing energy consumption', 'is_correct' => true, 'variation' => 600],
        ]);

        // Question 7 — QCU
        $question7 = $quiz->questions()->create([
            'type' => QuestionType::QCU,
            'question_text' => 'What is the primary role of safety stock?',
            'time' => 30,
        ]);

        $question7->choices()->createMany([
            ['choice_text' => 'Reduce transportation costs', 'is_correct' => false, 'variation' => -200],
            ['choice_text' => 'Improve product quality', 'is_correct' => false, 'variation' => -300],
            ['choice_text' => 'Compensate for demand or delivery fluctuations', 'is_correct' => true, 'variation' => 1000],
            ['choice_text' => 'Eliminate the need for production', 'is_correct' => false, 'variation' => -400],
        ]);

        // Question 8 — QCM
        $question8 = $quiz->questions()->create([
            'type' => QuestionType::QCM,
            'question_text' => 'What are the impacts of a good fault detection rate?',
            'time' => 40,
        ]);

        $question8->choices()->createMany([
            ['choice_text' => 'Reduced downtime', 'is_correct' => true, 'variation' => 800],
            ['choice_text' => 'Improved safety', 'is_correct' => true, 'variation' => 700],
            ['choice_text' => 'Increased waste', 'is_correct' => false, 'variation' => -500],
            ['choice_text' => 'Better maintenance planning', 'is_correct' => true, 'variation' => 600],
        ]);




        $decision = $jeu->decision()->create([
            'titre' => 'Invest in New Equipment',
            'description' => 'Décidez d’investir ou non dans de nouveaux équipements de production.',
            'duration' => 5, 
        ]);

        $parametres = $jeu->parametres()->pluck('id', 'nom');

        // Choix 1 : Robotique
        $choix1 = $decision->choixDecisions()->create([
            'choice_text' => 'Robotique',
        ]);

        $niveauData1 = [
            [
                'level' => 1,
                'cout' => 5000,
                'description' => 'Basic automation with robotic arms.',
                'impacts' => [
                    ['param' => 'production_rate', 'val' => 1.05],
                    ['param' => 'cost_of_labor', 'val' => 0.98],
                ],
            ],
            [
                'level' => 2,
                'cout' => 6000,
                'description' => 'Smart sensors optimizing robotic performance.',
                'impacts' => [
                    ['param' => 'production_rate', 'val' => 1.10],
                    ['param' => 'cost_of_labor', 'val' => 0.95],
                ],
            ],
            [
                'level' => 3,
                'cout' => 7000,
                'description' => 'Collaborative robots enhancing productivity.',
                'impacts' => [
                    ['param' => 'production_rate', 'val' => 1.15],
                    ['param' => 'cost_of_labor', 'val' => 0.92],
                ],
            ],
            [
                'level' => 4,
                'cout' => 9000,
                'description' => 'Advanced automation reducing human error.',
                'impacts' => [
                    ['param' => 'production_rate', 'val' => 1.20],
                    ['param' => 'cost_of_labor', 'val' => 0.85],
                ],
            ],
        ];

        foreach ($niveauData1 as $data) {
            $level = $choix1->levels()->create([
                'level' => $data['level'],
                'description' => $data['description'],
                'cout' => $data['cout'],
            ]);
            foreach ($data['impacts'] as $impact) {
                $level->effets()->create([
                    'id_parametre' => $parametres[$impact['param']],
                    'valeur_impact' => $impact['val'],
                ]);
            }
        }

        // Choix 2 : Green Energy
        $choix2 = $decision->choixDecisions()->create([
            'choice_text' => 'Green Energy',
        ]);

        $niveauData2 = [
            [
                'level' => 1,
                'cout' => 40000,
                'description' => 'Partial adoption of renewable energy.',
                'impacts' => [
                    ['param' => 'CO2_emission', 'val' => 0.95],
                    ['param' => 'maintenance_cost', 'val' => 0.98],
                ],
            ],
            [
                'level' => 2,
                'cout' => 45000,
                'description' => 'Solar panel installation reducing grid dependency.',
                'impacts' => [
                    ['param' => 'CO2_emission', 'val' => 0.90],
                    ['param' => 'maintenance_cost', 'val' => 0.96],
                    ['param' => 'sales_rate', 'val' => 1.02],

                ],
            ],
            [
                'level' => 3,
                'cout' => 50000,
                'description' => 'Optimization of energy consumption.',
                'impacts' => [
                    ['param' => 'CO2_emission', 'val' => 0.85],
                    ['param' => 'maintenance_cost', 'val' => 0.94],
                    ['param' => 'sales_rate', 'val' => 1.03],

                ],
            ],
            [
                'level' => 4,
                'cout' => 60000,
                'description' => '50% green power supply.',
                'impacts' => [
                    ['param' => 'CO2_emission', 'val' => 0.80],
                    ['param' => 'maintenance_cost', 'val' => 0.92],
                    ['param' => 'sales_rate', 'val' => 1.05],

                ],
            ],
        ];
        
        foreach ($niveauData2 as $data) {
            $level = $choix2->levels()->create([
                'level' => $data['level'],
                'description' => $data['description'],
                'cout' => $data['cout'],
            ]);
            foreach ($data['impacts'] as $impact) {
                $level->effets()->create([
                    'id_parametre' => $parametres[$impact['param']],
                    'valeur_impact' => $impact['val'],
                ]);
            }
        }

        // Choix 3 : Cybersecurity
        $choix3 = $decision->choixDecisions()->create([
            'choice_text' => 'Cybersecurity',
        ]);
            
        $niveauData3 = [
            [
                'level' => 1,
                'cout' => 25000,
                'description' => 'Basic antivirus and firewall setup.',
                'impacts' => [
                    ['param' => 'attack_success_rate', 'val' => 0.98],
                ],
            ],
            [
                'level' => 2,
                'cout' => 30000,
                'description' => 'Advanced authentication and access control.',
                'impacts' => [
                    ['param' => 'attack_success_rate', 'val' => 0.96],
                ],
            ],
            [
                'level' => 3,
                'cout' => 35000,
                'description' => 'Security Operations Center (SOC) implementation.',
                'impacts' => [
                    ['param' => 'attack_success_rate', 'val' => 0.94],
                ],
            ],
            [
                'level' => 4,
                'cout' => 45000,
                'description' => 'Real-time AI-based threat detection.',
                'impacts' => [
                    ['param' => 'attack_success_rate', 'val' => 0.92],
                ],
            ],
        ];

        foreach ($niveauData3 as $data) {
            $level = $choix3->levels()->create([
                'level' => $data['level'],
                'description' => $data['description'],
                'cout' => $data['cout'],
            ]);
            foreach ($data['impacts'] as $impact) {
                $level->effets()->create([
                    'id_parametre' => $parametres[$impact['param']],
                    'valeur_impact' => $impact['val'],
                ]);
            }
        }

        // Choix 4 : Artificial Intelligence 
        $choix4 = $decision->choixDecisions()->create([
            'choice_text' => 'Artificial Intelligence',
        ]);

        $niveauData4 =[
            [
                'level' => 1,
                'cout' => 30000,
                'description' => 'Basic predictive maintenance.',
                'impacts' => [
                    ['param' => 'production_rate', 'val' => 1.02],
                    ['param' => 'breakdown_rate', 'val' => 0.98],
                ],
            ],
            [
                'level' => 2,
                'cout' => 40000,
                'description' => 'ML-driven fault detection.',
                'impacts' => [
                    ['param' => 'production_rate', 'val' => 1.05],
                    ['param' => 'breakdown_rate', 'val' => 0.95],
                ],
            ],
            [
                'level' => 3,
                'cout' => 50000,
                'description' => 'Deep-learning scheduling optimizer.',
                'impacts' => [
                    ['param' => 'production_rate', 'val' => 1.08],
                    ['param' => 'breakdown_rate', 'val' => 0.92],
                ],
            ],
            [
                'level' => 4,
                'cout' => 65000,
                'description' => 'Real-time adaptive control.',
                'impacts' => [
                    ['param' => 'production_rate', 'val' => 1.12],
                    ['param' => 'breakdown_rate', 'val' => 0.90],
                ],
            ],
        ];

        foreach ($niveauData4 as $data) {
            $level = $choix4->levels()->create([
                'level' => $data['level'],
                'description' => $data['description'],
                'cout' => $data['cout'],
            ]);
            foreach ($data['impacts'] as $impact) {
                $level->effets()->create([
                    'id_parametre' => $parametres[$impact['param']],
                    'valeur_impact' => $impact['val'],
                ]);
            }
        }

        // Choix 5 : Big Data
        $choix5 = $decision->choixDecisions()->create([
            'choice_text' => 'Big Data',
        ]);

        $niveauData5 =[
            [
                'level' => 1,
                'cout' => 20000,
                'description' => 'Basic data logging',
                'impacts' => [
                    ['param' => 'maintenance_cost', 'val' => 0.99],
                    ['param' => 'breakdown_rate', 'val' => 0.99],
                ],
            ],
            [
                'level' => 2,
                'cout' => 30000,
                'description' => 'Historical analytics.',
                'impacts' => [
                    ['param' => 'maintenance_cost', 'val' => 0.97],
                    ['param' => 'breakdown_rate', 'val' => 0.97],
                ],
            ],
            [
                'level' => 3,
                'cout' => 40000,
                'description' => 'Predictive alerts.',
                'impacts' => [
                    ['param' => 'maintenance_cost', 'val' => 0.95],
                    ['param' => 'breakdown_rate', 'val' => 0.95],
                ],
            ],
            [
                'level' => 4,
                'cout' => 55000,
                'description' => 'Streaming analytics integration.',
                'impacts' => [
                    ['param' => 'maintenance_cost', 'val' => 0.92],
                    ['param' => 'breakdown_rate', 'val' => 0.92],
                ],
            ],
        ];

        foreach ($niveauData5 as $data) {
            $level = $choix5->levels()->create([
                'level' => $data['level'],
                'description' => $data['description'],
                'cout' => $data['cout'],
            ]);
            foreach ($data['impacts'] as $impact) {
                $level->effets()->create([
                    'id_parametre' => $parametres[$impact['param']],
                    'valeur_impact' => $impact['val'],
                ]);
            }
        }

        // Choix 6 : Vertical Integration
        $choix6 = $decision->choixDecisions()->create([
            'choice_text' => 'Vertical Integration',
        ]);

        $niveauData6 =[
            [
                'level' => 1,
                'cout' => 12000,
                'description' => 'Shop floor to MOM linkage.',
                'impacts' => [
                    ['param' => 'scrap_rate', 'val' => 0.99],
                    ['param' => 'sales_rate', 'val' => 1.01],
                ],
            ],
            [
                'level' => 2,
                'cout' => 22000,
                'description' => 'ERP-MES synchronization.',
                'impacts' => [
                    ['param' => 'scrap_rate', 'val' => 0.97],
                    ['param' => 'sales_rate', 'val' => 1.04],
                ],
            ],
            [
                'level' => 3,
                'cout' => 32000,
                'description' => 'Integrated SCM execution.',
                'impacts' => [
                    ['param' => 'scrap_rate', 'val' => 0.95],
                    ['param' => 'sales_rate', 'val' => 1.07],
                ],
            ],
            [
                'level' => 4,
                'cout' => 45000,
                'description' => 'End-to-end digital thread.',
                'impacts' => [
                    ['param' => 'scrap_rate', 'val' => 0.92],
                    ['param' => 'sales_rate', 'val' => 1.10],
                ],
            ],
        ];

        foreach ($niveauData6 as $data) {
            $level = $choix6->levels()->create([
                'level' => $data['level'],
                'description' => $data['description'],
                'cout' => $data['cout'],
            ]);
            foreach ($data['impacts'] as $impact) {
                $level->effets()->create([
                    'id_parametre' => $parametres[$impact['param']],
                    'valeur_impact' => $impact['val'],
                ]);
            }
        }

        // Choix 7 : Horizontal Integration
        $choix7 = $decision->choixDecisions()->create([
            'choice_text' => 'Horizontal Integration',
        ]);

        $niveauData7 =[
            [
                'level' => 1,
                'cout' => 10000,
                'description' => 'Cell-to-cell data sharing',
                'impacts' => [
                    ['param' => 'sales_rate', 'val' => 1.02],
                    ['param' => 'raw_material_cost', 'val' => 0.99],
                ],
            ],
            [
                'level' => 2,
                'cout' => 20000,
                'description' => 'Line-wide MES coordination.',
                'impacts' => [
                    ['param' => 'sales_rate', 'val' => 1.05],
                    ['param' => 'raw_material_cost', 'val' => 0.97],
                ],
            ],
            [
                'level' => 3,
                'cout' => 30000,
                'description' => 'Cross-enterprise APIs',
                'impacts' => [
                    ['param' => 'sales_rate', 'val' => 1.08],
                    ['param' => 'raw_material_cost', 'val' => 0.95],
                ],
            ],
            [
                'level' => 4,
                'cout' => 40000,
                'description' => 'Real-time shop-floor integration.',
                'impacts' => [
                    ['param' => 'sales_rate', 'val' => 1.12],
                    ['param' => 'raw_material_cost', 'val' => 0.93],
                ],
            ],
        ];

        foreach ($niveauData7 as $data) {
            $level = $choix7->levels()->create([
                'level' => $data['level'],
                'description' => $data['description'],
                'cout' => $data['cout'],
            ]);
            foreach ($data['impacts'] as $impact) {
                $level->effets()->create([
                    'id_parametre' => $parametres[$impact['param']],
                    'valeur_impact' => $impact['val'],
                ]);
            }
        }

        // Choix 8 : Augmented Reality
        $choix8 = $decision->choixDecisions()->create([
            'choice_text' => 'Augmented Reality',
        ]);

        $niveauData8 =[
            [
                'level' => 1,
                'cout' => 15000,
                'description' => 'AR overlays for maintenance.',
                'impacts' => [
                    ['param' => 'average_downtime', 'val' => 0.98],
                    ['param' => 'production_rate', 'val' => 1.02],
                ],
            ],
            [
                'level' => 2,
                'cout' => 25000,
                'description' => 'Interactive assembly guidance.',
                'impacts' => [
                    ['param' => 'average_downtime', 'val' => 0.95],
                    ['param' => 'production_rate', 'val' => 1.05],
                ],
            ],
            [
                'level' => 3,
                'cout' => 35000,
                'description' => 'Remote expert support.',
                'impacts' => [
                    ['param' => 'average_downtime', 'val' => 0.90],
                    ['param' => 'production_rate', 'val' => 1.08],
                ],
            ],
            [
                'level' => 4,
                'cout' => 45000,
                'description' => 'Enterprise-wide AR platform.',
                'impacts' => [
                    ['param' => 'average_downtime', 'val' => 0.85],
                    ['param' => 'production_rate', 'val' => 1.12],
                ],
            ],
        ];

        foreach ($niveauData8 as $data) {
            $level = $choix8->levels()->create([
                'level' => $data['level'],
                'description' => $data['description'],
                'cout' => $data['cout'],
            ]);
            foreach ($data['impacts'] as $impact) {
                $level->effets()->create([
                    'id_parametre' => $parametres[$impact['param']],
                    'valeur_impact' => $impact['val'],
                ]);
            }
        }

        $simulation = $jeu->simulation()->create([
            'titre' => 'Run the Production Line',
            'description' => 'Simulate a month of production based on your decisions regarding machine maintenance and staff allocation.',
        ]);
    }
}
