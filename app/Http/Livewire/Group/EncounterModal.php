<?php

namespace App\Http\Livewire\Group;

use Livewire\Component;
use WireUi\Traits\Actions;

class EncounterModal extends Component
{
    use Actions;

    public $group;
    public $encounter;

    public function mount($group, $encounter = null)
    {
        dd($encounter);
    }

    public function render()
    {
        return view('livewire.group.encounter-modal');
    }
}
