<?php

namespace App\View\Pages;

use App\Models\GameSession;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class PreGame extends Component
{
    public $session;
    public $player_name;

    public function mount($sessionId)
    {
        $this->session = GameSession::where('id', $sessionId)->firstOrFail();

        if (Auth::check()) {
            $this->player_name = Auth::user()->name;
        }
    }

    // function to return to join  -- not working --
    public function redirectToJoin()
    {
        dd('redirectToJoin called');
        return redirect()->to(route('join'));
    }

    public function confirmPlayer()
    {
        if (!$this->player_name) {
            session()->flash('error', 'Veuillez entrer votre nom.');
            return;
        }

        if (Auth::check()) {
            $player = Auth::user();
            $playerId = $player->id;

            if (!$this->session->players()->where('id_user', $player->id)->exists()) {
                $this->session->players()->attach($player->id, [
                    'player_name' => $this->player_name,
                    'is_guest' => false,
                    'joined_at' => now()
                ]);
            }
        } else {

            $guestUser = \App\Models\User::create([
                'name' => $this->player_name,  
                'is_guest' => true,
            ]);
            
            $this->session->players()->attach($guestUser->id, [
                'player_name' => $this->player_name,
                'is_guest' => true,
                'joined_at' => now()
            ]);
            $playerId = $guestUser->id;
        }

        if ($this->session->status === 'active') {
            return redirect()->route('game.play', ['sessionId' => $this->session->id, 'playerId' => $playerId]);
        }
        
        return redirect()->route('game.waiting', ['sessionId' => $this->session->id, 'playerId' => $playerId]);
    }

    #[Layout('components.layouts.base')]
    public function render()
    {
        return view('pages.pre-game');
    }
}
