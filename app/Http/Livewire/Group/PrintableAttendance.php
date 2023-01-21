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
        abort_unless(auth()->user()->hasRole('admin') or $group->community_id === auth()->user()->community_id, 403);
        $this->group = $group;
        $this->group->load(['community','grade','users']);
        $this->encounters = $group->encounters;
        $this->students = $group->students()->orderBy('name', 'asc')->get();
        $this->students->load('encounters')->pluck('date');
    }

    public function render()
    {
        return view('livewire.group.printable-attendance')->layout(false);
    }
}
