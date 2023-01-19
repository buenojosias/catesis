<?php

namespace App\Http\Livewire\Group;

use App\Models\Group;
use Carbon\Carbon;
use Livewire\Component;

class Show extends Component
{
    public $group;
    public $catechists;
    public $encounters;
    public $students;
    public $students_count;
    public $showFormModal;

    public function openFormModal() {
        $this->showFormModal = true;
    }

    public function mount(Group $group)
    {
        $this->group = $group;
        $this->catechists = $group->users;
        $this->students_count = $group->students()->count();
    }

    public function showStudents()
    {
        if($this->students)
            return;
        $this->students = $this->group->students()->orderBy('name', 'asc')->get();
        foreach($this->students as $student) {
            $student->age = Carbon::parse($student->birth)->age;
        }
    }

    public function showEncounters()
    {
        if($this->encounters)
            return;
        $this->encounters = $this->group->encounters()->orderBy('date', 'asc')->with('theme')->get();
    }

    public function hideStudents()
    {
        $this->students = null;
    }

    public function hideEncounters()
    {
        $this->encounters = null;
    }

    public function render()
    {
        return view('livewire.group.show');
    }
}
