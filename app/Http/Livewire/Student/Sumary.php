<?php

namespace App\Http\Livewire\Student;

use App\Models\Student;
use Carbon\Carbon;
use Livewire\Component;

class Sumary extends Component
{
    public $student;
    public $group;
    public $catechists;

    public $rematriculationModal;
    public $groups;

    public function mount($student) {
        $this->student = $student;
        $this->student->age = Carbon::parse($student->birth)->age;
        $this->student->load('grade');
        $this->group = $this->student->groups()->where('finished', false)->where('year', date('Y'))->first();
        $this->catechists = $this->group->users ?? [];
    }

    public function openRematriculationModal() {
        $this->rematriculationModal = true;
    }

    public function submitRematriculation() {
        $this->emit('submitRematriculation');
    }

    public function render()
    {
        return view('livewire.student.sumary');
    }
}
