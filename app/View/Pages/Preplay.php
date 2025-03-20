<?php

namespace App\View\Pages;

use Livewire\Component;
use App\Models\GameSession;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

class Preplay extends Component
{
    public $session;
    public $player;

    public function mount($sessionId, $playerId)
    {
        $this->session = GameSession::where('id', $sessionId)
                ->where('status', 'waiting')
                ->firstOrFail();
        $this->player = User::findOrfail($playerId);
    }
    #[On('game-started')]
    public function redirectToGame()
    {
        $this->redirectRoute('game.play', [
            'sessionId' => $this->session->id,
            'playerId' => $this->player->id
        ]);
    }

    public function checkStatus()
    {
        $this->session->refresh();
        
        if ($this->session->status === 'active') {
            $this->redirectToGame();
        }
    }
    
    #[Layout('components.layouts.base')]
    public function render()
    {
        return view('pages.preplay');
    }
}
