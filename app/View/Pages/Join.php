<?php

namespace App\View\Pages;

use App\Models\GameSession;
use Illuminate\Support\Facades\Auth;
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
            session()->flash('error', 'Code d\'adhésion invalide');
            return;
        }

        if (Auth::check()) {
            $player = Auth::user();
            $session->players()->attach($player->id, [
                'is_guest' => false,
                'joined_at' => now()
            ]);
            return redirect()->route('game.preplay', ['session' => $session->id]);

        } else {
            return redirect()->route('player.name', ['session' => $session->id]);
        }
    }
    public function render()
    {
        return view('pages.join');
    }
}
