<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;

class History extends Component
{
    public $groups;

    public function mount($student)
    {
        $this->groups = $student->groups()->with('grade')->get();
    }

    public function render()
    {
        return view('livewire.student.history');
    }
}
