<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        return view('groups.index');
    }

    public function show(Group $group)
    {
        abort_unless(auth()->user()->hasRole('admin') or $group->community_id === auth()->user()->community_id, 403);
        if(auth()->user()->hasRole('admin')) {
            $group->load('community');
        }

        $group->load('grade');
        return view('groups.show', [
            'group' => $group,
        ]);
    }
}
