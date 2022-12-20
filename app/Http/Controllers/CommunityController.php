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

        return view('communities.show', [
            'community' => $community
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
