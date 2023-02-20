<?php

namespace App\Http\Livewire\Catechist;

use Livewire\Component;

class About extends Component
{
    public $catechist;
    public $groups;
    public $weekdays = ['Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado'];

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
