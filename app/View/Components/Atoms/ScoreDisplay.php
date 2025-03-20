<?php

namespace App\View\Components\Atoms;

use App\Models\Score;
use App\Models\GameSession;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On; 

class ScoreDisplay extends Component
{
    public $score = 0;
    public $playerId;
    public $sessionId;
    public $player;
    public $session;

    public function mount($playerId, $sessionId)
    {
        $this->playerId = $playerId;
        $this->sessionId = $sessionId;

        $this->session = GameSession::where('id', $sessionId)
            ->where('status', 'active')
            ->firstOrFail();

        $this->player = User::findOrFail($playerId);
    }

    #[On('scoreUpdated')]
    public function refreshScore($newScore)
    {
        $this->score = Score::where('id_user', $this->player->id)
            ->where('id_session', $this->session->id)
            ->value('score') ?? 0;
            
        $this->score = $newScore;
    }

    public function render()
    {
        return view('components.atoms.score-display');
    }
}