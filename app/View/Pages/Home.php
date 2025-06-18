<?php

namespace App\View\Pages;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Home extends Component
{
    #[Layout('layouts.guest')]
    public function render()
    {
        return view('pages.home');
    }
}