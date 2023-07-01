<?php

namespace App\Http\Livewire\Encounter;

use App\Models\Student;
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
    public $showChangeModal = false;

    public $changeStudent, $changeAttendance;

    public $newAttendance, $newComment = '';

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

    public function openChangeModal($student) {
        $this->changeStudent = $student;
        $this->showChangeModal = true;
    }

    public function closeChangeModal() {
        $this->showChangeModal = false;
    }

    public function saveChange() {
        if($this->newAttendance && in_array($this->newAttendance, ['C','F','J','R'])) {
            $this->encounter->students()->sync([$this->changeStudent['id'] => ['attendance' => $this->newAttendance]], false);
            Student::find($this->changeStudent['id'])->comments()->create([
                'user_id' => auth()->user()->id,
                'description' => "Frequência alterada para $this->newAttendance. ". $this->newComment
            ]);
            $this->notification()->success($description = 'Registro alterado com sucesso.');
            $this->newAttendance = $this->newComment = '';
            $this->showChangeModal = false;
        } else {
            return;
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
