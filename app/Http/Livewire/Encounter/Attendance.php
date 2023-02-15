<?php

namespace App\Http\Livewire\Encounter;

use Livewire\Component;
use WireUi\Traits\Actions;

class Attendance extends Component
{
    use Actions;

    public $encounter;
    public $group;
    public $students;
    public $studentsWithAttendence;
    public $studentsWithoutAttendence;
    public $selectedAttendance = [];
    public $canRegisterAttendance;

    public function submitAttendance()
    {
        foreach ($this->selectedAttendance as $key => $selected) {
            $this->selectedAttendance['student_id'] = $key;
            $this->selectedAttendance['attendance'] = $selected;
            $student_id = $key;
            $attendance = $selected;
            $this->encounter->students()->syncWithoutDetaching([$student_id => ['attendance' => $attendance]]);
        }
        $this->notification()->success($description = 'Registros salvos com sucesso.');
        $this->resetAttendance();
    }

    public function resetAttendance()
    {
        $this->selectedAttendance = [];
    }

    public function mount($encounter, $group)
    {
        $this->encounter = $encounter;
        $this->group = $group;

        if($this->group->users()->find(auth()->user()) || (auth()->user()->hasAnyRole(['coordinator','secretary']) && $this->group->community_id === auth()->user()->community_id))
        {
            $this->canRegisterAttendance = true;
        } else {
            $this->canRegisterAttendance = false;
        }
    }

    public function render()
    {
        if($this->canRegisterAttendance == true) {
            $this->studentsWithoutAttendence = $this->group->active_students()->whereDoesntHave('encounters', function ($query) {
                return $query->where('encounter_id', $this->encounter->id);
            })->orderBy('name', 'asc')->get();
        }
        $this->studentsWithAttendence = $this->encounter->students()->orderBy('name', 'asc')->get();
        return view('livewire.encounter.attendance');
    }
}
