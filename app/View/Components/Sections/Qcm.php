<?php

namespace App\View\Components\Sections;

use App\Models\Effet;
use App\Models\ParametreSessionJoueur;
use Livewire\Component;
use App\Models\Quiz;
use App\Models\Submission;
use App\Models\SessionJoueur;
use App\View\Pages\Game;
use Livewire\Attributes\On;

class Qcm extends Component
{
    public $joinedPlayer;
    public $quiz;
    public $questions;
    public $currentIndex = 0;
    public $quizFinished = false;
    public array $selectedChoices = [];
    public $cash;


    public function mount($sessionId, $playerId, $quizId)
    {
        $this->joinedPlayer = SessionJoueur::where('id_session',$sessionId)
            ->where('id_player',$playerId)
            ->firstOrFail();

        $this->quiz = Quiz::where('id', $quizId)->firstOrFail();
        $this->questions = $this->quiz->questions()->with('choices')->get();
        
        $this->cash = ParametreSessionJoueur::where('session_joueur_id', $this->joinedPlayer->id)
            ->whereHas('parametre', function ($query) {
                $query->where('nom', 'cash');
            })
            ->value('valeur') ?? 0;
    }

    public function submitAnswer($choiceId)
    {
        if ($this->quizFinished) {
            return;
        }

        $question = $this->questions[$this->currentIndex];    
        $isCorrect = $question->choices()->where('id', $choiceId)->value('is_correct');
        
        Submission::create([
            'id_session_joueur' =>$this->joinedPlayer->id,
            'choix_reponse_id' => $choiceId,
            'is_correct' => $isCorrect,
            'submitted_at' => now(),
        ]);
        $this->goToNextQuestion();
    }

    public function submitQCM()
    {
        if ($this->quizFinished) {
            return;
        }

        $question = $this->questions[$this->currentIndex];

        foreach ($this->selectedChoices as $choiceId) {
            $isCorrect = $question->choices()->where('id', $choiceId)->value('is_correct');

            Submission::create([
                'id_session_joueur' => $this->joinedPlayer->id,
                'choix_reponse_id' => $choiceId,
                'is_correct' => $isCorrect,
                'submitted_at' => now(),
            ]);
        }

        $this->selectedChoices = [];
        $this->goToNextQuestion();
    }

    private function goToNextQuestion()
    {
        if ($this->currentIndex < count($this->questions) - 1) {
            $this->currentIndex++;
        } else {
            $this->quizFinished = true;
            
        }
    }
    #[On('qcmFinished')]
    public function applyEffect()
    {
        $this->quizFinished = true;
        $this->storeEffects();
        $this->applyEffects();
    }

    private function storeEffects()
    {
        $reponses = Submission::where('id_session_joueur', $this->joinedPlayer->id)->get();
        $parametre = $this->quiz->parametre;

        foreach ($reponses as $reponse) {
            $choixReponse = $reponse->choixReponse;
            if (!$choixReponse) continue;

            $variation = $reponse->is_correct ? $choixReponse->variation : -$choixReponse->variation;

            Effet::create([
                'session_joueur_id' => $this->joinedPlayer->id,
                'id_submission'=>  $reponse->id,
                'id_parametre' => $parametre->id,
                'variation' => $variation,
            ]);
        }
    }

    private function applyEffects()
    {
        $parametre = $this->quiz->parametre;
        foreach (SessionJoueur::where('id_session', $this->joinedPlayer->id_session)->get() as $sessionJoueur) {

            $variationTotale = Effet::where('id_parametre', $parametre->id)
                ->where('session_joueur_id', $sessionJoueur->id)
                ->sum('variation');

            $this->cash = $parametre->valeur_initiale + $variationTotale;

            $newCash=ParametreSessionJoueur::updateOrCreate(
                [
                    'session_joueur_id' => $sessionJoueur->id,
                    'id_parametre' => $parametre->id,
                ],
                [
                    'valeur' => $this->cash,
                ]
            );
            // update cash 
            $this->dispatch('scoreUpdated', $newCash->cash);
        }
    }

    public function render()
    {
        return view('components.sections.qcm');
    }
}
