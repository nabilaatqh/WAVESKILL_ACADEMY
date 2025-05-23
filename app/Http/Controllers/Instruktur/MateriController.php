<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function index(Request $request)
    {
        $query = Materi::whereHas('course', function ($q) {
            $q->where('instruktur_id', Auth::id());
        });

        if ($request->course_id) {
            $query->where('course_id', $request->course_id);
        }

        $materi = $query->latest()->get();
        $courseList = Course::where('instruktur_id', Auth::id())->get();

        return view('instruktur.materi.index', compact('materi', 'courseList'));
    }

    public function create(Course $course)
    {
        if ($course->instruktur_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return view('instruktur.materi.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        if ($course->instruktur_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'file' => 'required|file|mimes:pdf,docx,pptx,mp4|max:20480',
        ]);

        $filePath = $request->file('file')->store('materi_files', 'public');

        Materi::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file_path' => $filePath,
            'course_id' => $course->id,
        ]);

        return redirect()->route('instruktur.materi.index')->with('success', 'Materi berhasil ditambahkan.');
    }

    public function show(Materi $materi)
    {
        if ($materi->course->instruktur_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return view('instruktur.materi.show', compact('materi'));
    }

    public function edit(Materi $materi)
    {
        if ($materi->course->instruktur_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $courseList = Course::where('instruktur_id', Auth::id())->get();

        return view('instruktur.materi.edit', compact('materi', 'courseList'));
    }

    public function update(Request $request, Materi $materi)
    {
        if ($materi->course->instruktur_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,docx,pptx,mp4|max:20480',
            'course_id' => 'required|exists:course,id',
        ]);

        if ($request->hasFile('file')) {
            if ($materi->file_path && Storage::disk('public')->exists($materi->file_path)) {
                Storage::disk('public')->delete($materi->file_path);
            }
            $filePath = $request->file('file')->store('materi_files', 'public');
            $materi->file_path = $filePath;
        }

        $materi->judul = $request->judul;
        $materi->deskripsi = $request->deskripsi;
        $materi->course_id = $request->course_id;
        $materi->save();

        return redirect()->route('instruktur.materi.index')->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy(Materi $materi)
    {
        if ($materi->course->instruktur_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        if ($materi->file_path && Storage::disk('public')->exists($materi->file_path)) {
            Storage::disk('public')->delete($materi->file_path);
        }

        $materi->delete();

        return redirect()->route('instruktur.materi.index')->with('success', 'Materi berhasil dihapus.');
    }
}
