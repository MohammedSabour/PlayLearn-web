<?php

namespace App\View\Components\Atoms;

use Livewire\Component;
use App\Models\GameSession;

class EndSessionButton extends Component
{
    public $sessionId;

    public function mount($sessionId)
    {
        $this->sessionId = $sessionId;
    }

    public function endSession()
    {
        $session = GameSession::find($this->sessionId);

        if ($session && $session->status !== 'finished') {
            $session->update(['status' => 'finished']);
            return redirect()->route('filament.admin.resources.quizzes.index');
        }
    }

    public function render()
    {
        return view('components.atoms.end-session-button');
    }
}
