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
        public function index(Request $request)
        {
            $student = auth()->guard('student')->user();

            // Ambil semua course yang diikuti student
            $enrolledCourses = $student->enrolledCourses()->with(['materis', 'projects', 'instruktur'])->get();
            // Ambil ID course yang dipilih dari query string, jika ada
             $selectedCourseId = $request->input('course_id') ?? ($enrolledCourses->first()->id ?? null);
            // Ambil course pertama sebagai currentCourse (bisa pakai pilihan jika mau)
            $currentCourse = $enrolledCourses->firstWhere('id', $selectedCourseId);

            // Ambil materi dan project dari course aktif
            $materi = $currentCourse ? $currentCourse->kelass->flatMap->materis : collect();
            $projects = $currentCourse ? $currentCourse->projects : collect();

            return view('student.dashboard', compact('enrolledCourses', 'currentCourse', 'materi', 'projects'));
        }    
}
