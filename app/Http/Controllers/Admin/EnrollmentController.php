<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enrollment;

class EnrollmentController extends Controller
{
    /**
     * Tampilkan daftar enrollment yang butuh verifikasi
     */
    public function index(Request $request)
    {
        $status = $request->get('status');
        $query = Enrollment::with(['student', 'course']);

        if ($status && in_array($status, ['pending', 'approved', 'rejected'])) {
            $query->where('status', $status);
        }

        $enrollments = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.enrollments.index', compact('enrollments', 'status'));
    }

    /**
     * Setujui enrollment
     */
    public function approve($id)
    {
        $enrollment = Enrollment::with('course.groups')->findOrFail($id);
        $enrollment->status = 'approved';
        $enrollment->save();

        $studentId = $enrollment->student_id;

        // Otomatis tambahkan student ke semua grup milik course ini
        foreach ($enrollment->course->groups as $group) {
            if (!$group->students()->where('student_id', $studentId)->exists()) {
                $group->students()->attach($studentId);
            }
        }

        return redirect()->route('admin.enrollments.index')
            ->with('success', 'Enrollment telah disetujui dan student ditambahkan ke grup.');
    }

    /**
     * Tolak enrollment
     */
    public function reject($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->status = 'rejected';
        $enrollment->save();

        return redirect()->route('admin.enrollments.index')
            ->with('error', 'Enrollment telah ditolak.');
    }
}
