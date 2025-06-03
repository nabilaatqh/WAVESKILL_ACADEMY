<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class StudentCertificateController extends Controller
{
    // Tampilkan daftar course yang punya sertifikat
    public function index()
    {
        $student = auth()->guard('student')->user();

        // Hanya tampilkan course yang punya sertifikat dan sudah diselesaikan
        $courses = $student->enrollcourses()
            ->with(['projects', 'instruktur'])
            ->whereHas('projects') // pastikan ada project
            ->get()
            ->filter(function ($course) use ($student) {
                $completed = $student->submissions()->where('course_id', $course->id)->count();
                return $completed >= $course->projects->count() && $course->certificate_file;
            });

        return view('student.certificates.index', [
            'coursesWithCertificates' => $courses,
        ]);
    }

    // Tampilkan preview sertifikat
    public function show($courseId)
    {
        $student = Auth::guard('student')->user();
        $course = Course::with(['projects', 'instruktur'])->findOrFail($courseId);

        $completed = $student->submissions()->where('course_id', $courseId)->count();
        $total = $course->projects->count();

        if ($completed < $total || !$course->certificate_file) {
            return redirect()->back()->with('error', 'Sertifikat belum tersedia.');
        }

        return view('pdf.certificate', [
            'studentName' => $student->name,
            'courseName' => $course->nama_course,
            'instrukturName' => $course->instruktur->name ?? '-',
            'templatePath' => asset('storage/' . $course->certificate_file),
        ]);
    }

    // Unduh PDF Sertifikat
    public function download($courseId)
    {
        $student = Auth::guard('student')->user();
        $course = Course::with(['projects', 'instruktur'])->findOrFail($courseId);

        $completed = $student->submissions()->where('course_id', $courseId)->count();
        $total = $course->projects->count();

        if ($completed < $total || !$course->certificate_file) {
            return redirect()->back()->with('error', 'Sertifikat belum tersedia.');
        }

        $pdf = Pdf::loadView('pdf.certificate', [
            'studentName' => $student->name,
            'courseName' => $course->nama_course,
            'instrukturName' => $course->instruktur->name ?? '-',
            'templatePath' => public_path('storage/' . $course->certificate_file),
        ])->setPaper('A4', 'landscape');

        return $pdf->download('sertifikat-' . Str::slug($student->name) . '-' . Str::slug($course->nama_course) . '.pdf');
    }
}