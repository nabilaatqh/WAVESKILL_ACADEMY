<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Certificate;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;

class CertificateController extends Controller
{
    /**
     * Tampilkan daftar course yang sudah memiliki sertifikat untuk student ini.
     */
    public function index()
    {
        // 1. Ambil data student yang sedang login
        $student = Auth::guard('student')->user();

        // 2. Cari semua course_id yang di‐enroll oleh student dengan status “approved”
        $enrolledCourseIds = Enrollment::where('student_id', $student->id)
                                       ->where('status', 'approved')
                                       ->pluck('course_id');

        // 3. Dari course yang di‐enroll, pilih yang sudah memiliki minimal satu sertifikat untuk student ini
        //    Kita juga eager‐load relasi 'certificates' agar blade bisa langsung mengakses $course->certificates
        $coursesWithCertificates = Course::with(['certificates' => function($q) use ($student) {
                                                // Pastikan hanya sertifikat milik student ini
                                                $q->where('student_id', $student->id);
                                            }])
                                          ->whereIn('id', $enrolledCourseIds)
                                          ->whereHas('certificates', function($q) use ($student) {
                                              $q->where('student_id', $student->id);
                                          })
                                          ->get();

        // 4. Kirim koleksi Course + Certificate ke view
        return view('student.certificates.index', compact('coursesWithCertificates'));
    }

    /**
     * Tampilkan halaman detail sertifikat untuk satu course tertentu.
     * 
     * @param  int  $courseId
     */
    public function show($courseId)
    {
        $student = Auth::guard('student')->user();

        // 1. Pastikan student memang terdaftar di course ini (status “approved”)
        $isEnrolled = Enrollment::where('student_id', $student->id)
                                ->where('course_id', $courseId)
                                ->where('status', 'approved')
                                ->exists();

        if (! $isEnrolled) {
            abort(403, 'Anda tidak punya akses ke course ini.');
        }

        // 2. Ambil objek Course-nya (agar blade bisa men‐render nama / image / title, dll.)
        $course = Course::findOrFail($courseId);

        // 3. Ambil semua sertifikat yang dibuat untuk student ini & course ini
        $certificates = Certificate::where('course_id', $courseId)
                                   ->where('student_id', $student->id)
                                   ->get();

        return view('student.certificates.show', compact('course', 'certificates'));
    }
}
