<?php

namespace App\Http\Controllers;

use App\Models\Community;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    public function index()
    {
        return view('communities.index');
    }

    public function show(Community $community)
    {
        $catechists = $community->users()->orderBy('name', 'asc')->get();
        $students = $community->students()->where('status', 'Ativo')->count();
        $coordinators = $community->coordinators;
        $groups = $community->groups()->where('finished', false)->with('grade')->withCount('active_students')->get();
        return view('communities.show', [
            'community' => $community,
            'catechists' => $catechists,
            'coordinators' => $coordinators,
            'students' => $students,
            'groups' => $groups,
        ]);
    }

    public function edit(Community $community)
    {
        abort_unless(Auth::user()->can('community_edit') or (Auth::user()->can('community_edit_self') && $community['id'] === Auth::user()->community_id), 403);
        return view('communities.edit', [
            'community' => $community
        ]);
    }

}
