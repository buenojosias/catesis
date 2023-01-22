<?php

namespace App\Http\Livewire\Pastoral;

use Livewire\Component;

class RelatedList extends Component
{
    public $model;
    public $pastorals;
    public $display_list;

    public function loadList()
    {
        $this->pastorals = $this->model->pastorals()->with('community')->get();
        $this->display_list = true;
    }

    public function mount($model) {
        $this->model = $model;
    }

    public function render()
    {
        return view('livewire.pastoral.related-list');
    }
}
