<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /**
     * Display a listing of the courses.
     */
    public function index()
    {
        // Eager load instruktur and count students
        $courses = Course::with('instruktur')
            ->withCount('students')
            ->paginate(10);

        return view('admin.course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new course.
     */
    public function create()
    {
        // Get all instructors
        $instrukturs = User::where('role', 'instructor')->get();
        return view('admin.course.create', compact('instrukturs'));
    }

    /**
     * Store a newly created course in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_course'       => 'required|string|max:255',
            'instruktur_id'     => 'nullable|exists:users,id,role,instructor',
            'deskripsi'         => 'nullable|string',
            'harga'             => 'required|integer|min:0',
            'whatsapp_link'     => 'nullable|url',
            'banner_image'      => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'certificate_file'  => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Upload banner
        if ($request->hasFile('banner_image')) {
            $banner = $request->file('banner_image');
            $bannerPath = $banner->store('course_banners', 'public');
        }

        // Upload sertifikat
        if ($request->hasFile('certificate_file')) {
            $certificate = $request->file('certificate_file');
            $certificatePath = $certificate->store('certificates', 'public');
        }

        Course::create(
            $request->only('nama_course', 'instruktur_id', 'deskripsi', 'harga', 'whatsapp_link') + [
                'banner_image'      => $bannerPath ?? null,
                'certificate_file'  => $certificatePath ?? null,
            ]
        );

        return redirect()->route('admin.course.index')
                        ->with('success', 'Course berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified course.
     */
    public function edit(Course $course)
    {
        $instrukturs = User::where('role', 'instructor')->get();
        return view('admin.course.edit', compact('course', 'instrukturs'));
    }

    /**
     * Update the specified course in storage.
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'nama_course'       => 'nullable|string|max:255',
            'instruktur_id'     => 'nullable|exists:users,id,role,instructor',
            'deskripsi'         => 'nullable|string',
            'harga'             => 'nullable|integer|min:0',
            'whatsapp_link'     => 'nullable|url',
            'banner_image'      => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'certificate_file'  => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Ganti banner jika ada
        if ($request->hasFile('banner_image')) {
            if ($course->banner_image && Storage::disk('public')->exists($course->banner_image)) {
                Storage::disk('public')->delete($course->banner_image);
            }
            $banner = $request->file('banner_image');
            $bannerPath = $banner->store('course_banners', 'public');
        }

        // Ganti file sertifikat jika ada
        if ($request->hasFile('certificate_file')) {
            if ($course->certificate_file && Storage::disk('public')->exists($course->certificate_file)) {
                Storage::disk('public')->delete($course->certificate_file);
            }
            $certificate = $request->file('certificate_file');
            $certificatePath = $certificate->store('certificates', 'public');
        }

        $course->update(
            $request->only('nama_course', 'instruktur_id', 'deskripsi', 'harga', 'whatsapp_link') + [
                'banner_image'     => $bannerPath ?? $course->banner_image,
                'certificate_file' => $certificatePath ?? $course->certificate_file,
            ]
        );

        return redirect()->route('admin.course.index')
                        ->with('success', 'Course berhasil diperbarui');
    }

    /**
     * Remove the specified course from storage.
     */
    public function destroy(Course $course)
    {
        // Delete banner file if exists
        if ($course->banner_image && file_exists(public_path('storage/' . $course->banner_image))) {
            unlink(public_path('storage/' . $course->banner_image));
        }

        $course->delete();
        return redirect()->route('admin.course.index')
                         ->with('success', 'Course berhasil dihapus');
    }

    /**
     * Display the specified course details (admin view).
     */
    public function show(Course $course)
    {
        // Eager load instructor and students
        $course->load('instruktur', 'students');
        return view('admin.course.show', compact('course'));
    }
}
