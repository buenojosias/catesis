<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;

class History extends Component
{
    public $groups;
    public $student;

    public $rematriculationModal;

    public function mount($student)
    {
        $this->student = $student;
        $this->groups = $student->groups()->with('grade')->get();
    }

    public function openRematriculationModal() {
        $this->rematriculationModal = true;
    }

    public function submitRematriculation() {
        $this->emit('submitRematriculation');
    }

    public function render()
    {
        return view('livewire.student.history');
    }
}
