<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class StudentCertificateController extends Controller
{
    public function index()
    {
        $student = auth()->guard('student')->user();

        $courses = $student->courses()
            ->with(['projects', 'instruktur'])
            ->get();

        $student->load('submissions');

        return view('student.certificate.index', compact('courses', 'student'));
    }

    public function show($courseId)
    {
        $student = auth()->guard('student')->user();
        $course = Course::with(['projects', 'instruktur'])->findOrFail($courseId);

        $student->load('submissions');

        return view('student.certificate.show', compact('course', 'student'));
    }

    public function download($courseId)
    {
        $student = Auth::guard('student')->user();
        $course = Course::with('projects')->findOrFail($courseId);

        // Hitung project yang sudah diselesaikan student
        $completed = $student->submissions()
            ->where('course_id', $courseId)
            ->count();

        $total = $course->projects->count();

        // Cek apakah semua project sudah selesai
        if ($completed < $total) {
            return redirect()->back()->with('error', 'Kamu belum menyelesaikan semua project.');
        }

        if (!$course->certificate_file) {
            return redirect()->back()->with('error', 'Sertifikat belum tersedia untuk course ini.');
        }

        // Buat PDF sertifikat dengan nama student
        $pdf = Pdf::loadView('pdf.certificate', [
            'studentName' => $student->name,
            'courseName' => $course->nama_course,
            'instrukturName' => $course->instruktur->name ?? '-',
            'templatePath' => public_path('storage/' . $course->certificate_file),
        ])->setPaper('A4', 'landscape');

        return $pdf->download('sertifikat-' . Str::slug($student->name) . '.pdf');
    }
}