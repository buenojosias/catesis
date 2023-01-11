<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\Grade;
use App\Models\Group;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        return view('grades.index');
    }

    public function show(Grade $grade)
    {
        if(auth()->user()->hasRole('admin')) {
            /*$groups = Group::query()
                ->where('finished', false)
                ->where('grade_id', $grade->id)
                ->with('community')
                ->withCount('students')
                ->get()
                ->groupBy('community_id')
                ->sum('students');*/

            /*$communities = Community::query()
                ->with('groups', function($query) {
                    return $query->where('grade_id', $grade->id)->withCount('students');
                })
                ->get();*/

            //return($communities);
        }

        return view('grades.show', [
            'grade' => $grade,
        ]);
    }
}
