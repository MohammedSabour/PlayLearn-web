<?php

namespace App\View\Components\Layouts;

use App\Models\GameSession;
use Livewire\Component;

class Base extends Component
{
    public $sessionId;

    public function mount()
    {
        $this->sessionId = GameSession::where('status', 'waiting')
            ->latest()
            ->value('id');
    }

    public function render()
    {
        return view('components.layouts.base', [
            'sessionId' => $this->sessionId,
        ]);
    }
}
