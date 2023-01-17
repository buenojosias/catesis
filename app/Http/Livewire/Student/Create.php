<?php

namespace App\Http\Livewire\Student;

use App\Models\Student;
use Livewire\Component;

class Create extends Component
{
    public $student;
    public $kinship;

    protected $listeners = [
        'emitStudent',
        'emitKinship',
    ];

    public function emitStudent(Student $student)
    {
        $this->student = $student;
    }

    public function emitKinship($kinship)
    {
        $this->kinship = $kinship;
    }

    public function render()
    {
        return view('livewire.student.create');
    }
}
