<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;

class History extends Component
{
    public $groups;
    public $student;

    public function mount($student)
    {
        $this->student = $student;
        $this->groups = $student->groups()->with('grade')->get();
    }

    public function render()
    {
        return view('livewire.student.history');
    }
}
