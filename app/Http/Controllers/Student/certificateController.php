<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Models\Course;
use App\Models\enrollment;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    public function index()
    {
        $student = Auth::guard('student')->user();

        // Ambil semua course yang student ikuti dan sudah memiliki sertifikat
        $coursesWithCertificates = $student->enrolledcourse()->whereHas('certificates')->with('certificates')->get();

        return view('student.certificates.index', compact('coursesWithCertificates'));
    }

    public function show($courseId)
    {
        $student = Auth::guard('student')->user();

        // Pastikan student punya akses ke course ini
        $course = $student->enrolledcourse()->where('id', $courseId)->firstOrFail();

        // Ambil sertifikat terkait course
        $certificates = $course->certificates()->where('student_id', $student->id)->get();

        return view('student.certificates.show', compact('course', 'certificates'));
    }

}
