<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class groupController extends Controller
{
    public function index()
    {
        $student = auth()->guard('student')->user();

        // Ambil grup yang diikuti student dengan data course-nya
        $groups = $student->groups()->with('course')->get();

        return view('student.groups.index', compact('groups'));
    }
}
