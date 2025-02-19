<?php

namespace App\View\Components\Organismes;

use App\Models\GameSession;
use Livewire\Component;

class NavBarGame extends Component
{
    public $sessionId;

    public function mount()
    {
        $this->sessionId = GameSession::where('status', 'waiting')
            ->latest()
            ->value('id');
    }

    public function endSession()
    {
        $session = GameSession::find($this->sessionId);

        if ($session && $session->status !== 'finished') {
            $session->endSession();
            return redirect()->route('filament.admin.resources.quizzes.index');
        }
    }

    public function render()
    {
        return view('components.organismes.nav-bar-game');
    }
}
