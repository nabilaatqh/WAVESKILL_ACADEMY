<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Materi;

class MateriController extends Controller
{
    // Menampilkan semua materi dari course yang telah dibeli student
    public function index()
    {
        $user = Auth::guard('student')->user();

        $course = Course::whereHas('students', function ($q) use ($user) {
            $q->where('student_id', $user->id);
        })->with('materis')->get();

        return view('student.materi.index', compact('course'));
    }

    // Menampilkan detail materi tertentu
    public function show($id)
    {
        $student = Auth::guard('student')->user();
        $materi = Materi::findOrFail($id);

        // Pastikan relasi enrollcourses sudah dimuat
        $enrolledCourses = $student->enrollcourses()->with('materis')->get();

        if (!$enrolledCourses || !$enrolledCourses->contains('id', $materi->course_id)) {
            abort(403, 'Kamu tidak memiliki akses ke materi ini.');
        }

        return view('student.materi.show', compact('materi'));
    }
}