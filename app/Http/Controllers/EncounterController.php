<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EncounterController extends Controller
{
    public function index($section = 'proximos')
    {
        return view('encounters.index', compact(['section']));
    }
}
