<?php

namespace App\View\Pages;

use Livewire\Component;
use App\Events\Broadcast;
use App\Models\GameSession;
use Livewire\Attributes\Layout;

class Session extends Component
{
    public $session;
    public $errorMessage = null;

    
    public function mount($sessionId)
    {
        $this->session = GameSession::with('players')->findOrFail($sessionId);
    }

    public function startGame()
    {
        if ($this->session->status === 'waiting' && $this->session->players->isNotEmpty()) {
            $this->session->update(['status' => 'active']);

            // event redirect players to game -- not working -- 
            $this->dispatch('game-started')->to(Preplay::class);

            return redirect()->route('session.active', ['sessionId' => $this->session->id]);
        }
        #$this->dispatch('errorMessage', 'Impossible de démarrer la session : aucun joueur inscrit.');
        $this->errorMessage = 'Nécessite 1 participant pour commencer';
    }

    #[Layout('components.layouts.base')]
    public function render()
    {
        return view('pages.session');
    }
}