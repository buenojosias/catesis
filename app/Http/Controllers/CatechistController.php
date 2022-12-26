<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CatechistController extends Controller
{
    public function index()
    {
        return view('catechists.index');
    }

    public function show(User $user)
    {
        $profile = $user->load('profile');
        $community = $user->load('community');
        return view('catechists.show', [
            'user' => $user,
            'profile' => $profile,
        ]);
    }
}
