<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\Student;
use App\Models\Grade;
use App\Models\Group;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function __construct() {
        $grade;
    }

    public function index()
    {
        return view('grades.index');
    }

    public function show(Grade $grade)
    {
        if(auth()->user()->hasRole('admin')) {
            $this->grade = $grade;
            $communities = Community::query()->get();
            $communities->loadCount(['active_students' => function($query) {
                $query->where('grade_id', $this->grade->id);
            }]);
        }
        $themes = $grade->themes()->orderBy('sequence', 'asc')->get();

        return view('grades.show', [
            'grade' => $grade,
            'themes' => $themes,
            'communities' => $communities ?? null,
        ]);
    }
}
