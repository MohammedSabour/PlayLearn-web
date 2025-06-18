<?php

namespace App\View\Pages;

use Livewire\Component;
use App\Events\Broadcast;
use App\Models\GameSession;
use App\Models\Parametre;
use App\Models\ParametreSessionJoueur;
use App\Models\SessionJoueur;
use Livewire\Attributes\Layout;

class Session extends Component
{
    public $session;
    public $sessionJoueurs;
    public $errorMessage = null;

    
    public function mount($sessionId)
    {
        $this->session = GameSession::with('players')->findOrFail($sessionId);
        $this->sessionJoueurs = SessionJoueur::where('id_session', $sessionId)->get();
    }

    public function updateSessionJoueurs()
    {
        $this->sessionJoueurs = SessionJoueur::where('id_session', $this->session->id)->get();
    }

    public function startGame()
    {
        if ($this->session->status === 'waiting' && $this->session->players->isNotEmpty()) {
            $this->session->update(['status' => 'active']);

            foreach ($this->session->players as $player) {
                $sessionJoueur = SessionJoueur::where('id_session', $this->session->id)
                                              ->where('id_player', $player->id)
                                              ->first();
    
                foreach (Parametre::all() as $parametre) {
                    ParametreSessionJoueur::create([
                        'session_joueur_id' => $sessionJoueur->id,
                        'id_parametre' => $parametre->id,
                        'valeur' => $parametre->valeur_initiale,
                    ]);
                }
            }
            return redirect()->route('session.active', ['sessionId' => $this->session->id]);
        }
        $this->errorMessage = 'Nécessite 1 participant pour commencer';
    }

    #[Layout('components.layouts.base')]
    public function render()
    {
        return view('pages.session');
    }
}