<?php

namespace App\View\Pages;

use App\Models\GameSession;
use App\Models\SessionJoueur;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Fin extends Component
{
    public $player;
    public $session;
    public $sessionJoueurs;
    public $game;
    public $quiz;
    public $cashParametre;
    public SessionJoueur $currentSessionJoueur;

    public function mount($sessionId, $playerId)
    {
        $this->session = GameSession::with(['players'])->findOrFail($sessionId);
        $this->sessionJoueurs = SessionJoueur::where('id_session', $sessionId)->get();  
        $this->game = $this->session->jeu;
        $this->quiz = $this->game->quiz;
        $this->cashParametre = $this->quiz->parametre;
        $this->currentSessionJoueur = SessionJoueur::findOrFail($playerId);
    }

    public function getSortedSessionJoueursProperty()
    {
        return $this->sessionJoueurs
            ->sortByDesc(fn($joueur) => $joueur->getCash($this->cashParametre->id))
            ->values();
    }

    #[Layout('components.layouts.base')]
    public function render()
    {
        return view('pages.fin');
    }
}
