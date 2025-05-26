<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with('student', 'course')
            ->where('status', 'pending')
            ->paginate(10);

        return view('admin.enrollments.index', compact('enrollments'));
    }

    public function approve($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->status = 'approved';
        $enrollment->save();

        // Pastikan pivot course_student update kalau perlu (atau ubah logika)
        // Biasanya sudah otomatis dengan relasi many-to-many jika kamu buat manual

        return redirect()->back()->with('success', 'Enrollment berhasil diverifikasi.');
    }

    public function reject($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->status = 'rejected';
        $enrollment->save();

        return redirect()->back()->with('success', 'Enrollment ditolak.');
    }
}
