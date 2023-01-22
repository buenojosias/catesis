<?php

namespace App\Http\Livewire\Pastoral;

use Livewire\Component;

class Index extends Component
{
    public $list;

    public function mount($list = null)
    {
        $this->list = $list;
    }

    public function render()
    {
        return view('livewire.pastoral.index');
    }
}
