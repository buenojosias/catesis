<?php

namespace App\Http\Livewire\Catechist;

use App\Models\Training;
use Livewire\Component;

class History extends Component
{
    public $catechist;
    public $groups;
    public $trainings, $catechistTrainings;

    public function loadTrainings() {
        if(!$this->trainings) {
            $this->trainings = Training::all();
            $catechistTrainings = $this->catechist->trainings;
            $this->catechistTrainings = $catechistTrainings->pluck('id')->toArray();
        }
    }

    public function syncTraining($id) {
        if(in_array($id, $this->catechistTrainings)) {
            $this->catechist->trainings()->attach($id);
        } else {
            $this->catechist->trainings()->detach($id);
        }
    }

    public function mount($catechist)
    {
        $this->groups = $catechist->groups()->where('finished', true)->with('grade')->withCount('students')->orderBy('year', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.catechist.history');
    }
}
