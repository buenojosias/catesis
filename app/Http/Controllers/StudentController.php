<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
    {
        return view('students.index');
    }

    public function show(Student $student, $section = null)
    {
        abort_unless(Auth::user()->hasRole('admin') or $student->community_id === Auth::user()->community_id, 403);
        // $groups = $student->groups()->with('grade')->get();
        return view('students.show', [
            'section' => $section,
            'student' => $student,
            // 'groups' => $groups,
        ]);
    }

    public function create()
    {
        return view('students.create');
    }

    public function edit(Student $student)
    {
        abort_unless(Auth::user()->hasRole('admin') or $student->community_id === Auth::user()->community_id, 403);
        return view('students.edit', [
            'student' => $student
        ]);
    }

    public function delete()
    {
        //
    }
}
