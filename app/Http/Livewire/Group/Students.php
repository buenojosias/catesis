<?php

namespace App\Http\Livewire\Group;

use Carbon\Carbon;
use Livewire\Component;

class Students extends Component
{
    public $students;

    public function mount($group)
    {
        $this->students = $group->students()->with('encounters', function ($query) use ($group) {
            return $query->where('group_id', $group->id)->wherePivot('attendance', 'F');
        })->orderBy('name', 'asc')->get();
        foreach ($this->students as $student) {
            $student->age = Carbon::parse($student->birthday)->age;
        }
    }

    public function render()
    {
        return view('livewire.group.students');
    }
}
