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
        // Validasi input
        $request->validate([
            'nama_course' => 'required|string|max:255',
            'instruktur_id' => 'nullable|exists:users,id,role,instructor',
            'deskripsi' => 'nullable|string',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
        ]);

        // Simpan gambar jika ada
        if ($request->hasFile('banner_image')) {
            // Mendapatkan nama asli file dan ekstensi
            $filename = pathinfo($request->file('banner_image')->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $request->file('banner_image')->getClientOriginalExtension();
            $finalName = $filename . '.' . $extension; // Membuat nama file yang benar

            // Simpan gambar di public/storage/course_banners
            $imagePath = $request->file('banner_image')->storeAs('course_banners', $finalName, 'public');
        }

        // Simpan data course
        Course::create($request->only('nama_course', 'instruktur_id', 'deskripsi') + [
            'banner_image' => $imagePath ?? null, // Simpan path gambar
        ]);

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
            'instruktur_id' => 'nullable|exists:users,id,role,instructor',
            'deskripsi' => 'nullable|string',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
        ]);

        // Cek apakah ada file banner_image yang di-upload
        if ($request->hasFile('banner_image')) {
            // Hapus gambar lama jika ada
            if ($course->banner_image) {
                Storage::disk('public')->delete($course->banner_image);
            }

            // Simpan gambar baru
            $filename = pathinfo($request->file('banner_image')->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $request->file('banner_image')->getClientOriginalExtension();
            $finalName = $filename . '.' . $extension;
            $imagePath = $request->file('banner_image')->storeAs('course_banners', $finalName, 'public');
        }

        // Update course dengan banner_image baru (jika ada)
        $course->update($request->only('nama_course', 'instruktur_id', 'deskripsi') + [
            'banner_image' => $imagePath ?? $course->banner_image, // Gunakan gambar lama jika tidak ada gambar baru
        ]);

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
