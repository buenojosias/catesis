<?php

namespace App\Http\Controllers;

use App\Models\Encounter;
use App\Models\Group;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public $weekdays = [
        'Domingo',
        'Segunda-feira',
        'Terça-feira',
        'Quarta-feira',
        'Quinta-feira',
        'Sexta-feira',
        'Sábado'
    ];

    public function index()
    {
        return view('groups.index');
    }

    public function show(Group $group, $section = null)
    {
        abort_unless(auth()->user()->hasAnyRole(['admin','coordinator']) or $group->community_id === auth()->user()->community_id, 403);
        $group->load('grade');
        return view('groups.show', [
            'group' => $group,
            'section' => $section,
            'weekdays' => $this->weekdays,
        ]);
    }

    public function encounter(Group $group, $encounter_id)
    {
        abort_unless(auth()->user()->hasRole('admin') or $group->community_id === auth()->user()->community_id, 403);
        $encounter = $group->encounters()->with('theme')->findOrFail($encounter_id);
        return view('livewire.group.encounter', [
            'group' => $group,
            'encounter' => $encounter,
        ]);
    }
}
