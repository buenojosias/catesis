<?php

namespace App\Http\Livewire\Catechist;

use App\Models\Characteristic;
use Livewire\Component;

class About extends Component
{
    public $catechist;
    public $characteristics, $catechistCharacteristics;
    public $groups;
    public $weekdays = ['Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado'];

    public function loadCharacteristics() {
        if(!$this->characteristics) {
            $this->characteristics = Characteristic::all();
            $catechistCharacteristics = $this->catechist->characteristics;
            $this->catechistCharacteristics = $catechistCharacteristics->pluck('id')->toArray();
        }
    }

    public function syncCharacteristc($id) {
        if(in_array($id, $this->catechistCharacteristics)) {
            $this->catechist->characteristics()->attach($id);
        } else {
            $this->catechist->characteristics()->detach($id);
        }
    }

    public function mount($catechist)
    {
        $this->catechist = $catechist;
        $this->catechist->load('profile');
        $this->groups = $catechist->groups()->where('year', date('Y'))->where('finished', false)->with('grade')->withCount('students')->orderBy('year', 'desc')->get();
        if(!auth()->user()->community_id) {
            $this->catechist->load('community');
        }
    }

    public function render()
    {
        return view('livewire.catechist.about');
    }
}
