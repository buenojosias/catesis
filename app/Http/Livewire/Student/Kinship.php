<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;

class Kinship extends Component
{
    public $kinships;

    public function mount($student)
    {
        $this->kinships = $student->kinships;
    }

    public function render()
    {
        return view('livewire.student.kinship');
    }
}
