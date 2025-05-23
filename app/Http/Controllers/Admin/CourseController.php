<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User; // Menggunakan model User, bukan Instruktur
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Tampilkan semua course
    public function index()
    {
        // Eager load instruktur dan hitung jumlah student
        $courses = Course::with('instruktur')->withCount('students')->paginate(10);

        return view('admin.course.index', compact('courses'));
    }

    // Tampilkan form tambah course
    public function create()
    {
        // Ambil semua instruktur dari users dengan role 'instructor'
        $instrukturs = User::where('role', 'instructor')->get(); // Ganti 'instruktur' dengan 'instructor'
        return view('admin.course.create', compact('instrukturs'));
    }

    // Simpan course baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_course' => 'required|string|max:255',
            'instruktur_id' => 'nullable|exists:users,id,role,instructor', // Ganti 'instruktur' dengan 'instructor'
            'deskripsi' => 'nullable|string',
        ]);

        Course::create($request->only('nama_course', 'instruktur_id', 'deskripsi'));

        return redirect()->route('admin.course.index')->with('success', 'Course berhasil ditambahkan');
    }

    // Tampilkan form edit course
    public function edit(Course $course)
    {
        // Ambil semua instruktur dari users dengan role 'instructor'
        $instrukturs = User::where('role', 'instructor')->get(); // Ganti 'instruktur' dengan 'instructor'
        return view('admin.course.edit', compact('course', 'instrukturs'));
    }

    // Update course
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'nama_course' => 'required|string|max:255',
            'instruktur_id' => 'nullable|exists:users,id,role,instructor', // Ganti 'instruktur' dengan 'instructor'
            'deskripsi' => 'nullable|string',
        ]);

        $course->update($request->only('nama_course', 'instruktur_id', 'deskripsi'));

        return redirect()->route('admin.course.index')->with('success', 'Course berhasil diperbarui');
    }

    // Hapus course
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.course.index')->with('success', 'Course berhasil dihapus');
    }

    // Detail course dengan daftar student
    public function show(Course $course)
    {
        // load relasi instruktur dan students
        $course->load('instruktur', 'students');
        return view('admin.course.show', compact('course'));
    }
}
