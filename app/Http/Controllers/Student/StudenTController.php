<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\LandingPageRequest;
use App\Http\Requests\Student\CourseRequest;
use App\Models\Enrollment;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
        public function index()
    {
        $student = auth()->guard('student')->user();

        // Ambil kursus yang sudah diikuti student
        $enrolledCourses = $student->enrolledCourses()->get();

        return view('student.dashboard', compact('enrolledCourses'));
    }
}
