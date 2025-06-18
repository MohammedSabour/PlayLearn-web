<?php

namespace App\View\Components\Atoms;

use App\Models\Score;
use App\Models\GameSession;
use App\Models\ParametreSessionJoueur;
use App\Models\SessionJoueur;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On; 

class ScoreDisplay extends Component
{
    public $joinedPlayer;
    public $cash;

    public function mount($playerId, $sessionId)
    {
        $this->joinedPlayer = SessionJoueur::where('id_session',$sessionId)
            ->where('id_player',$playerId)
            ->firstOrFail();

        $this->cash = ParametreSessionJoueur::where('session_joueur_id', $this->joinedPlayer->id)
            ->whereHas('parametre', function ($query) {
                $query->where('nom', 'cash');
            })
            ->value('valeur') ?? 0;
    }

    #[On('scoreUpdated')]
    public function refreshScore()
    {
        $this->cash = ParametreSessionJoueur::where('session_joueur_id', $this->joinedPlayer->id)
            ->whereHas('parametre', function ($query) {
                $query->where('nom', 'cash');
            })
            ->value('valeur') ?? 0;
    }

    public function render()
    {
        return view('components.atoms.score-display');
    }
}