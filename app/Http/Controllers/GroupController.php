<?php

namespace App\Http\Controllers;

use App\Models\Encounter;
use App\Models\Group;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public $weekdays = ['Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado'];

    public function index()
    {
        return view('groups.index', [
            'weekdays' => $this->weekdays,
        ]);
    }

    public function show(Group $group, $section = null)
    {
        $group->load('grade');
        return view('groups.show', [
            'group' => $group,
            'section' => $section,
            'weekdays' => $this->weekdays,
        ]);
    }

    public function encounter(Group $group, $encounter_id)
    {
        $role = session('role');
        $community_id = session('community_id');
        $encounter = $group->encounters()->with('theme')->findOrFail($encounter_id);
        return view('livewire.group.encounter', [
            'role' => $role,
            'group' => $group,
            'encounter' => $encounter,
        ]);
    }

    public function printCard(Group $group)
    {
        $weekdays = ['Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado'];
        $group->load(['grade','community','parish']);
        $catechists = $group->users;
        $students = $group->students()->orderBy('name', 'asc')->get();
        return view('printable.group-card', compact(['weekdays','group','catechists','students']));
    }
}
