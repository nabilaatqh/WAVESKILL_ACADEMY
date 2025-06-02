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
        // 1. Ambil data student yang sedang login
        $student = Auth::guard('student')->user();

        // 2. Ambil seluruh Course yang di‐enroll oleh student (status “approved”), with relasi instruktur
        $enrolledCourses = Course::whereIn('id', function($q) use ($student) {
                $q->select('course_id')
                  ->from('enrollments')
                  ->where('student_id', $student->id)
                  ->where('status', 'approved');
            })
            ->with('instruktur')
            ->get();

        // 3. Tentukan selectedCourseId:
        //    - Jika ada query parameter “course_id” (di URL), pakai itu
        //    - Jika tidak, pilih ID course pertama di koleksi $enrolledCourses
        //    - Jika student belum enroll sama sekali, maka null
        $selectedCourseId = $request->input('course_id')
                             ?? ($enrolledCourses->first()->id ?? null);

        // 4. Temukan objek “selectedCourse” dari koleksi $enrolledCourses
        $selectedCourse = $enrolledCourses->firstWhere('id', $selectedCourseId);

        // 5. Ambil materi dan project dari selectedCourse (jika ada)
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

        // 6. Kembalikan view ‘student.dashboard’ dengan semua variabel yang dibutuhkan
        return view('student.dashboard', compact(
            'enrolledCourses',
            'selectedCourse',
            'materi',
            'projects'
        ));
    }
}
