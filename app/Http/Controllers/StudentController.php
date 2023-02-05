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
        return view('students.show', [
            'section' => $section,
            'student' => $student,
        ]);
    }

    public function printCard(Student $student)
    {
        $monthLabels = array('0', 'janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho', 'junho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro');
        $user = auth()->user();
        $user->load('roles');
        $parish = auth()->user()->parish;
        $community = auth()->user()->community;
        $student->load(['profile','address','contact']);
        $enroller = $student->kinships()->wherePivot('is_enroller', true)->with(['profile','contact'])->first();
        return view('printable.student-card', compact(['user','parish','community','student','enroller','monthLabels']));
    }

    public function create()
    {
        return view('students.create');
    }

    public function delete()
    {
        //
    }
}
