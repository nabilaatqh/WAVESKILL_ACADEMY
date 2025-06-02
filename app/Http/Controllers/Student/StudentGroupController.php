<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use App\Models\Enrollment;
use App\Models\Group;

class StudentGroupController extends Controller
{
    public function index()
    {
        $student = auth()->guard('student')->user();

        // Ambil grup yang diikuti student dengan data course-nya
        $groups = $student->groups()->with('course')->get();

        return view('student.groups.index', compact('groups'));
    }
}
