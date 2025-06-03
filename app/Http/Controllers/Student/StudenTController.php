<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Materi;
use App\Models\Project;
use App\Models\Enrollment;
use App\Models\Group;
use App\Models\submission;

class StudentController extends Controller
{
    /**
     * Tampilkan dashboard student, termasuk kursus yang di‐enroll, materi, dan project.
     * 
     * - Jika ada ?course_id=XXX pada URL, pakai itu sebagai selectedCourse.
     * - Jika tidak ada, pakai course pertama di $enrolledCourses (atau null jika kosong).
     */
    public function index(Request $request)
    {
        $student = Auth::guard('student')->user();

        $enrolledCourses = Course::whereIn('id', function($q) use ($student) {
                $q->select('course_id')
                  ->from('enrollments')
                  ->where('student_id', $student->id)
                  ->where('status', 'approved');
            })
            ->with('instruktur')
            ->get();

        
        $selectedCourseId = $request->input('course_id')
                             ?? ($enrolledCourses->first()->id ?? null);

        $selectedCourse = $enrolledCourses->firstWhere('id', $selectedCourseId);

        if ($selectedCourse) {
            // a) Materi
            $materi = Materi::where('course_id', $selectedCourse->id)
                            ->orderBy('created_at', 'desc')
                            ->get();

            // b) Project
            $projects = Project::where('course_id', $selectedCourse->id)
                               ->orderBy('created_at', 'desc')
                               ->get();
        } else {
            // Jika tidak ada selectedCourse (misal belum enroll), kirim koleksi kosong
            $materi   = collect();
            $projects = collect();
        }

        return view('student.dashboard', compact(
            'enrolledCourses',
            'selectedCourse',
            'materi',
            'projects',
            'selectedCourseId'
        ));
    }
}
