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

    public function show(User $user, $section = 'sobre')
    {
        return view('catechists.show', [
            'section' => $section,
            'catechist' => $user,
        ]);
    }

    public function create() {
        return view('catechists.create');
    }
}
