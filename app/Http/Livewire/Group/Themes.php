<?php

namespace App\Http\Livewire\Group;

use Livewire\Component;

class Themes extends Component
{
    public $themes;

    public function mount($group)
    {
        $this->themes = $group->grade->themes()->orderBy('sequence', 'asc')->get();
    }

    public function render()
    {
        return view('livewire.group.themes');
    }
}
