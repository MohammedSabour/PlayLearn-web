<?php

namespace App\View\Pages;

use Livewire\Component;
use App\Models\GameSession;

class Session extends Component
{
    public $session;

    public function mount($sessionId)
    {
        $this->session = GameSession::with('players')->findOrFail($sessionId);
    }

    public function render()
    {
        return view('pages.session')->layout('components.layouts.base');
    }
}

