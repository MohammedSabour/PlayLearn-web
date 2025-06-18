<?php

namespace App\View\Pages;

use App\Models\GameSession;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Join extends Component
{
    public $membership_code;
    public $player_name;

    public function joinSession()
    {
        $session = GameSession::where('code_adhesion', $this->membership_code)
                                ->whereIn('status', ['waiting'])
                                ->first();
        if (!$session) {
            session()->flash('error', 'Code de jeu invalide');
            return;
        }
       return redirect()->route('game.preplay', ['sessionId' => $session->id]);
    }
 
    #[Layout('layouts.guest')]
    public function render()
    {
        return view('pages.join');
    }
}
