<?php

namespace App\View\Pages;

use App\Models\GameSession;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;


class SessionStart extends Component
{
    public $masterId;
    public $mode = 'solo';
    public $nombreRounds = 2;
    public $shuffle_questions = true;
    public $power_ups = true;
    public $show_leaderboard = true;

    public function startSession()
    {
        // code d'adession 
        $code = $this->secureRandomNumber(6);
        if (Auth::check()) {
            $this->masterId = Auth::user()->id;
        }

        // creat session
        $session = GameSession::create([
            'id_jeu' => 1,
            'id_master' =>  $this->masterId,
            'code_adhesion' => $code,
            'status' => 'waiting',
            'mode' => $this->mode,
            'nb_rounds' => $this->nombreRounds,
        ]);
        
        return redirect()->route('session.waiting', ['sessionId' => $session->id]);
    }

    private function secureRandomNumber($length = 6)
    {
        $number = '';
        for ($i = 0; $i < $length; $i++) {
            $number .= random_int(0, 9);
        }
        return $number;
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('pages.session-start');
    }
}
