<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EnrollmentController extends Controller
{
    public function showEnrollmentForm($courseId)
    {
        $course = Course::findOrFail($courseId);

        $studentId = Auth::id();
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

    public function processEnrollment(Request $request, $courseId)
    {
        $request->validate([
            'bukti_transfer' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $studentId = Auth::id();

        $path = $request->file('bukti_transfer')->store('enrollments', 'public');

        Enrollment::updateOrCreate(
            ['student_id' => $studentId, 'course_id' => $courseId],
            ['bukti_transfer' => $path, 'status' => 'pending', 'paid_at' => now()]
        );

        return redirect()->route('student.enroll.status', $courseId)
            ->with('success', 'Bukti pembayaran berhasil diupload. Tunggu verifikasi maksimal 1x24 jam.');
    }

    public function enrollmentStatus($courseId)
    {
        $studentId = Auth::id();

        $enrollment = Enrollment::where('student_id', $studentId)
            ->where('course_id', $courseId)
            ->firstOrFail();

        return view('student.enroll.status', compact('enrollment'));
    }
}