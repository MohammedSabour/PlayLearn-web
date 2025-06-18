<?php

namespace App\View\Components\Sections;

use App\Models\ChoixDecision;
use App\Models\Decision as ModelsDecision;
use App\Models\DecisionJoueur;
use App\Models\GameSession;
use App\Models\ParametreSessionJoueur;
use App\Models\SessionJoueur;
use App\View\Pages\Game;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Decision extends Component
{
    public $joinedPlayer;
    public $decision;
    public $choices;
    public $choicesLevels;
    public $session;
    public $cashParametre;
    public $decisionFinished = false;
    public $cash;

    public function mount($sessionId, $playerId, $decisionId)
    {
        $this->joinedPlayer = SessionJoueur::where('id_session',$sessionId)
            ->where('id_player',$playerId)
            ->firstOrFail();
        
        $this->session = GameSession::findOrFail($sessionId);
        $this->cashParametre = $this->session->jeu->quiz->parametre;
        
        $this->cash = ParametreSessionJoueur::where('session_joueur_id', $this->joinedPlayer->id)
            ->where('id_parametre', $this->cashParametre->id)
            ->value('valeur');

        $this->decision = ModelsDecision::findOrFail($decisionId);
        $this->choices = $this->decision->choixDecisions;
        $this->choicesLevels = ChoixDecision::with('levels')->get();
    }

    public function makeDecision($choixId, $levelId)
    {
        
        $choix = ChoixDecision::findOrFail($choixId);
        $level = $choix->levels()->findOrFail($levelId);

        $hasAlreadyInvested = DecisionJoueur::where('id_session_joueur', $this->joinedPlayer->id)
            ->where('id_level_choix', $levelId)
            ->exists();

        if ($hasAlreadyInvested) {
            session()->flash('error', 'Vous avez déjà investi dans ce niveau : "' . $choix->choice_text . '".');
            return;
        }
    
        $this->cash = ParametreSessionJoueur::where('session_joueur_id', $this->joinedPlayer->id)
            ->where('id_parametre', $this->cashParametre->id)
            ->first();

        if ($this->cash && $this->cash->valeur >= $level->cout) {
            $this->cash->valeur -= $level->cout;
            $this->cash->save();
            session()->flash('sucsses', 'Vous avez investi dans ce niveau : "' . $choix->choice_text . '".');

            // update cash
            $this->dispatch('scoreUpdated');

            DecisionJoueur::create([
                'id_session_joueur' => $this->joinedPlayer->id,
                'id_choix_decision' => $choixId,
                'id_level_choix' => $levelId,
                'submitted_at' => now(),
            ]);

            foreach ($level->effets as $impact) {
                $paramImpacte = ParametreSessionJoueur::where('session_joueur_id', $this->joinedPlayer->id)
                    ->where('id_parametre', $impact->id_parametre)
                    ->first();
        
                if ($paramImpacte) {
                    $paramImpacte->valeur *= $impact->valeur_impact;
                    $paramImpacte->save();

                    ParametreSessionJoueur::updateOrCreate(
                        [
                            'session_joueur_id' => $this->joinedPlayer->id,
                            'id_parametre' => $impact->id_parametre,
                        ],
                        [
                            'valeur' => $paramImpacte->valeur,
                            
                        ]
                    );
                }
            }

        }else{
            session()->flash('error', 'Fonds insuffisants pour investir dans : "' . $choix->choice_text . '"');
        }
    }
    
    public function render()
    {
        return view('components.sections.decision');
    }
}
