<?php

namespace App\View\Pages;

use App\Models\GameSession;
use App\Models\Submission;
use App\Models\User;
use App\Models\Score;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Game extends Component
{
    public $player;
    public $session;
    public $questions;
    public $currentIndex = 0;
    public $currentTime;
    public $score=0;
    public $quizFinished = false;

    public function mount($sessionId, $playerId)
    {
        $this->session = GameSession::where('id', $sessionId)
            ->where('status', 'active')
            ->firstOrFail();

        $this->player = User::findOrfail($playerId);
        $this->questions = $this->session->quiz->questions()->with('choices')->get();
        $this->currentTime = $this->questions[$this->currentIndex]->time ?? 10;
    }

    public function submitAnswer($choiceId)
    {
        if ($this->quizFinished) {
            session()->flash('message', 'Quiz terminé !'. $this->score);
            return;
        }

        $question = $this->questions[$this->currentIndex];
        $isCorrect = $question->choices()->where('id', $choiceId)->value('is_correct');

        Submission::create([
            'id_session' => $this->session->id,
            'id_user' => $this->player->id,
            'id_question' => $question->id,
            'id_selected_choice' => $choiceId,
            'is_correct' => $isCorrect,
            'submitted_at' => now(),
        ]);
        
        $points = $question->points ?? 1;
        if ($isCorrect){
            $this->score += $points;
        }

        $newScore=Score::updateOrCreate(
            [
                'id_user' => $this->player->id,
                'id_session' => $this->session->id,
            ],
            [
                'score' => $this->score,
                'completed_at' => now(),
            ]
        );
        $this->dispatch('scoreUpdated', $newScore->score);
        

        // question suivante
        if ($this->currentIndex < count($this->questions) - 1) {
            $this->currentIndex++;
            $this->currentTime = $this->questions[$this->currentIndex]->time ?? 10;
        } else {
            $this->quizFinished = true;
            session()->flash('message', 'Quiz terminé !'. $this->score);
        }
    }

    #[Layout('components.layouts.base')]
    public function render()
    {
        return view('pages.game', ['playerId' => $this->player->id, 'sessionId' => $this->session->id,]);
    }
}
