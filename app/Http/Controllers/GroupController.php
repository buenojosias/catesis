<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        return view('groups.index');
    }

    public function show(Group $group)
    {
        $students = $group->students;
        return view('groups.show', [
            'group' => $group,
        ]);
    }
}
