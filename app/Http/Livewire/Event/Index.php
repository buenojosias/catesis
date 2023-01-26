<?php

namespace App\Http\Livewire\Event;

use Livewire\Component;

class Index extends Component
{
    public $section;

    public function mount($section = null)
    {
        $this->section = $section;
    }

    public function render()
    {
        return view('livewire.event.index');
    }
}
