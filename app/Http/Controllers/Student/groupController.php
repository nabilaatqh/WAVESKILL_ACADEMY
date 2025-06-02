<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index()
    {
        // 1. Ambil student yang login
        $student = Auth::guard('student')->user();

        // 2. Ambil enrollments yang sudah approved
        $enrollments = Enrollment::with('course')
            ->where('student_id', $student->id)
            ->where('status', 'approved')
            ->get();

        // 3. Dapatkan semuanya course dari hasil enrollments
        $courses = $enrollments->pluck('course');

        // 4. Kirim ke view dengan nama ‘courses’
        return view('student.groups.index', compact('courses'));
    }
}
