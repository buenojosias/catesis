<?php

namespace App\Http\Controllers;

use App\Models\EnrollmentCode;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function __invoke(EnrollmentCode $code = null)
    {
        return view('enrollments.index', compact(['code']));
    }
}
