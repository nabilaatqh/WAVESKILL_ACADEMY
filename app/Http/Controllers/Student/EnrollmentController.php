<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    /**
     * Tampilkan form pembayaran & upload bukti QRIS
     */
    public function showEnrollmentForm($courseId)
    {
        $course = Course::findOrFail($courseId);
        $studentId = Auth::id();

        // Cek apakah sudah pernah enroll dan disetujui
        $existing = Enrollment::where('student_id', $studentId)
            ->where('course_id', $courseId)
            ->where('status', 'approved')
            ->first();

        if ($existing) {
            return redirect()->route('student.courses.show', $courseId)
                ->with('info', 'Anda sudah terdaftar di kursus ini.');
        }

        $qrisImageUrl = asset('images/qris_sample.png');

        return view('student.enroll.form', compact('course', 'qrisImageUrl'));
    }

    /**
     * Proses upload bukti pembayaran
     */
    public function processEnrollment(Request $request, $courseId)
    {
        $request->validate([
            'bukti_transfer' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $studentId = Auth::id();

        // Upload file ke storage
        $path = $request->file('bukti_transfer')->store('enrollments', 'public');

        // Simpan atau perbarui enrollment
        Enrollment::updateOrCreate(
            ['student_id' => $studentId, 'course_id' => $courseId],
            [
                'bukti_transfer' => $path,
                'status' => 'pending',
                'paid_at' => now(),
            ]
        );

        return redirect()->route('student.enroll.status', $courseId)
            ->with('success', 'Bukti pembayaran berhasil diupload. Menunggu verifikasi maksimal 1x24 jam.');
    }

    /**
     * Tampilkan status enrollment student
     */
    public function enrollmentStatus($courseId)
    {
        $studentId = Auth::id();

        $enrollment = Enrollment::where('student_id', $studentId)
            ->where('course_id', $courseId)
            ->firstOrFail();

        return view('student.enroll.status', compact('enrollment'));
    }
}
