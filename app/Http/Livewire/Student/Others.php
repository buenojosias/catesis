<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;

class Others extends Component
{
    public $student;

    public function mount($student) {
        $this->student = $student;
    }
    public function render()
    {
        return view('livewire.student.others');
    }
}
