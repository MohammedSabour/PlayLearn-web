<?php

namespace App\View\Components\Sections\Session;

use Livewire\Component;
use App\Models\GameSession;

class Main extends Component
{
    public $session;

    public function mount($sessionId)
    {
        $this->session = GameSession::with('players')->findOrFail($sessionId);
    }

    public function render()
    {
        return view('components.sections.session.main');
    }
}
