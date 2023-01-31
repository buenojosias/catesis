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
        $weekdays = ['Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado'];
        $user->load('profile');
        $user->load('community');
        $groups = $user->groups()->with('grade')->withCount('students')->orderBy('year', 'desc')->get();
        return view('catechists.show', [
            'catechist' => $user,
            'groups' => $groups,
            'weekdays' => $weekdays,
        ]);
    }

    public function create() {
        return view('catechists.create');
    }
}
