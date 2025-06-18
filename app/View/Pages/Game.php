<?php

namespace App\View\Pages;

use App\Models\GameSession;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class Game extends Component
{
    public $player;
    public $session;
    public $game;
    public $quiz;
    public $decision;
    public $simulation;
    public bool $showDecision = false;
    public bool $showSimulation = false;
    public bool $gamefiniched = false;
    public $nb_rounds;


    public function mount($sessionId, $playerId)
    {
        $this->session = GameSession::where('id', $sessionId)
            ->where('status', 'active')
            ->firstOrFail();

        $this->nb_rounds = $this->session->nb_rounds ?? 2;
        $this->player = User::findOrfail($playerId);
        $this->game = $this->session->jeu;
        
        $this->quiz = $this->game->quiz;
        $this->decision= $this->game->decision;
        $this->simulation= $this->game->simulation;
    }

    #[On('sessionFinished')] 
    public function endSession()
    {
        $this->redirectRoute('join');
    }
    
    public function checkStatus()
    {
        $this->session->refresh();
        
        if ($this->session->status === 'finished') {
            $this->endSession();
        }
    }

    #[On('decisionFinished')]
    public function showSimulation()
    {
        $this->showSimulation = true;
    }

    #[On('simulationFinished')] 
    public function showDecision()
    {
        $this->showSimulation = false;
    }

    #[On('gameFinished')] 
    public function gameFinished()
    {
        $this->redirectRoute('game.fin', [
            'playerId' => $this->player->id,
            'sessionId' => $this->session->id,
        ]);
    }

    #[Layout('components.layouts.base')]
    public function render()
    {
        return view('pages.game', [
            'playerId' => $this->player->id,
            'sessionId' => $this->session->id,
            'quizId' => $this->quiz->id,
            'decisionId' => $this->decision->id,
            'simulationId' => $this->simulation->id,
        ]);
    }
} 
