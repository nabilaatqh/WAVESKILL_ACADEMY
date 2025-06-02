<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use App\Models\Enrollment;
use App\Models\Group;

class groupController extends Controller
{
    public function index()
    {
        $student = auth()->guard('student')->user();

        // Ambil semua course yang sudah dibayar (approved)
        $approvedCourseIds = $student->enrollments()
            ->where('status', 'approved')
            ->pluck('course_id');

        // Ambil semua grup dari course yang sudah dibayar student
        $groups = \App\Models\Group::whereIn('course_id', $approvedCourseIds)
            ->with('course')
            ->get();
            
        return view('student.groups.index', compact('groups'));
    }
}
