<?php

namespace App\View\Pages;

use App\Models\GameSession;
use App\Models\SessionJoueur;
use GuzzleHttp\Psr7\Message;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class AdminGame extends Component
{
    public $session;
    public $sessionJoueurs;
    public $cashParametre;
    public $cash;
    public $game;
    public $quiz;
    public $message = null;

    public function mount($sessionId)
    {
        $this->session = GameSession::with(['players'])->findOrFail($sessionId);
        $this->sessionJoueurs = SessionJoueur::where('id_session', $sessionId)->get();  
        $this->game = $this->session->jeu;
        $this->quiz = $this->game->quiz;
        $this->cashParametre = $this->quiz->parametre;
    }

    public function getSortedSessionJoueursProperty()
    {
        return $this->sessionJoueurs
            ->sortByDesc(fn($joueur) => $joueur->getCash($this->cashParametre->id))
            ->values();
    }

    #[On('gameFinished')] 
    public function gameFinished()
    {
        $this->message = 'Game finiched';
    }
    
    #[Layout('components.layouts.base')]
    public function render()
    {
        return view('pages.admin-game');
    }
}
