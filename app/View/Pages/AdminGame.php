<?php

namespace App\View\Pages;

use App\Models\GameSession;
use Livewire\Attributes\Layout;
use Livewire\Component;

class AdminGame extends Component
{
    public $session;
    public $score;

    public function mount($sessionId)
    {
        $this->session = GameSession::with(['players', 'scores'])->findOrFail($sessionId);    
    }
    
    #[Layout('components.layouts.base')]
    public function render()
    {
        return view('pages.admin-game');
    }
}
