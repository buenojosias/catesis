<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        return view('grades.index');
    }

    public function show(Grade $grade)
    {
        return view('grades.show', [
            'grade' => $grade,
        ]);
    }
}
