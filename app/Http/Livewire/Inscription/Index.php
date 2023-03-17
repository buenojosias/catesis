<?php

namespace App\Http\Livewire\Inscription;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.inscription.index')->layout('layouts.inscription');
    }
}
