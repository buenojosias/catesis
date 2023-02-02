<?php

namespace App\Http\Controllers;

use App\Models\Kinship;
use Illuminate\Http\Request;

class KinshipController extends Controller
{
    public function index()
    {
        return view('kinships.index');
    }

    public function show(Kinship $kinship)
    {
        $students = $kinship->students()->with(['community','grade'])->get();

        return view('kinships.show', [
            'kinship' => $kinship,
            'students' => $students,
        ]);
    }
}
