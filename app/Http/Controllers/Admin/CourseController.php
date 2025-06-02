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
            'nama_course'   => 'required|string|max:255',
            'instruktur_id' => 'nullable|exists:users,id,role,instructor',
            'deskripsi'     => 'nullable|string',
            'harga'         => 'required|integer|min:0',
            'whatsapp_link' => 'nullable|url',
            'banner_image'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            $file      = $request->file('banner_image');
            $filename  = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
            $extension = $file->getClientOriginalExtension();
            $finalName = $filename . '-' . time() . '.' . $extension;

            $destination = public_path('storage/course_banners');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $finalName);
            $imagePath = 'course_banners/' . $finalName;
        }

        // Create the course, including 'harga'
        Course::create(
            $request->only('nama_course', 'instruktur_id', 'deskripsi', 'harga', 'whatsapp_link')
            + ['banner_image' => $imagePath ?? null]
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
            'nama_course'   => 'nullable|string|max:255',
            'instruktur_id' => 'nullable|exists:users,id,role,instructor',
            'deskripsi'     => 'nullable|string',
            'harga'         => 'nullable|integer|min:0',
            'whatsapp_link' => 'nullable|url',
            'banner_image'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // If new banner is uploaded, delete the old one first
        if ($request->hasFile('banner_image')) {
            if ($course->banner_image && file_exists(public_path('storage/' . $course->banner_image))) {
                unlink(public_path('storage/' . $course->banner_image));
            }

            $file      = $request->file('banner_image');
            $filename  = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
            $extension = $file->getClientOriginalExtension();
            $finalName = $filename . '-' . time() . '.' . $extension;

            $destination = public_path('storage/course_banners');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $finalName);
            $imagePath = 'course_banners/' . $finalName;
        }

        // Update including 'harga'
        $course->update(
            $request->only('nama_course', 'instruktur_id', 'deskripsi', 'harga', 'whatsapp_link')
            + ['banner_image' => $imagePath ?? $course->banner_image]
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
