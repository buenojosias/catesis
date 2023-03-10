<?php

namespace App\Http\Livewire\Group;

use App\Models\Group;
use Livewire\Component;

class PrintableAttendance extends Component
{
    public $group;
    public $encounters;
    public $students;

    public function mount(Group $group)
    {
        $this->group = $group;
        $this->group->load(['parish','community','grade','users']);
        $this->encounters = $group->encounters()->with('students')->get();
        $this->students = $group->students()->orderBy('name', 'asc')->get();
        $this->students->load('encounters')->pluck('date');
    }

    public function render()
    {
        return view('livewire.group.printable-attendance')->layout(false);
    }
}
