<?php

namespace App\Http\Livewire\Group;

use Livewire\Component;

class Encounter extends Component
{
    public $role;

    public function mount()
    {
        $this->role = session('role');
    }
    public function render($encounter)
    {
        return view('livewire.group.encounter');
    }
}
