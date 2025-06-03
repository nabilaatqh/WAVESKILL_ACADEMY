<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Materi;

class MateriController extends Controller
{
    public function show($id)
    {
        // 1) Cari materi berdasarkan ID (atau 404 kalau tidak ada)
        $materi = Materi::findOrFail($id);

        // 2) (Opsional) Periksa bahwa student boleh melihat materi ini
        $student = auth()->guard('student')->user();
        if (! $student->courses->pluck('id')->contains($materi->course_id)) {
            abort(403);
        }

        // 3) Tampilkan view detail materi
        return view('student.materi.index', compact('materi'));
    }
}
