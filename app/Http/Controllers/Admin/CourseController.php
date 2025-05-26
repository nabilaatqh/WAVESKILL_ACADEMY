<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Group;

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
            'instruktur_id' => 'nullable|exists:users,id,role,instructor',
            'deskripsi' => 'nullable|string',
            'whatsapp_link' => 'nullable|url',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Upload banner jika ada
        $imagePath = null;
        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');
            $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
            $extension = $file->getClientOriginalExtension();
            $finalName = $filename . '-' . time() . '.' . $extension;

            $destination = public_path('storage/course_banners');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $finalName);
            $imagePath = 'course_banners/' . $finalName;
        }

        // Simpan course
        $course = Course::create([
            'nama_course' => $request->nama_course,
            'instruktur_id' => $request->instruktur_id,
            'deskripsi' => $request->deskripsi,
            'whatsapp_link' => $request->whatsapp_link,
            'banner_image' => $imagePath,
        ]);

        // 🆕 Buat grup default otomatis
        Group::create([
            'title' => 'Grup ' . $course->nama_course,
            'whatsapp_link' => $request->whatsapp_link, // boleh null, bisa diedit nanti
            'course_id' => $course->id,
        ]);

        return redirect()->route('admin.course.index')->with('success', 'Course dan grup default berhasil dibuat');
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
            'whatsapp_link' => 'nullable|url',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('banner_image')) {
            if ($course->banner_image && file_exists(public_path('storage/' . $course->banner_image))) {
                unlink(public_path('storage/' . $course->banner_image));
            }

            $file = $request->file('banner_image');
            $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
            $extension = $file->getClientOriginalExtension();
            $finalName = $filename . '-' . time() . '.' . $extension;

            $destination = public_path('storage/course_banners');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $finalName);
            $imagePath = 'course_banners/' . $finalName;
        }

        $course->update(
            $request->only('nama_course', 'instruktur_id', 'deskripsi', 'whatsapp_link') + [
                'banner_image' => $imagePath ?? null,
            ]
        );

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
