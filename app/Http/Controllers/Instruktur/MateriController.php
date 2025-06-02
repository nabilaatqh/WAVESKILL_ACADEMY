<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Materi;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $course = Course::where('instruktur_id', $user->id)->get();
        return view('instruktur.materi.index', compact('course'));
    }

    public function create()
    {
        $course = Course::where('instruktur_id', Auth::id())->get();
        return view('instruktur.materi.create', compact('course'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tipe' => 'required|in:pdf,video,link',
            'file' => 'nullable|file|mimes:pdf,mp4|max:20480',
            'course_id' => 'required|exists:courses,id'
        ]);

        $materi = new Materi();
        $materi->judul = $request->judul;
        $materi->deskripsi = $request->deskripsi;
        $materi->tipe = $request->tipe;
        $materi->course_id = $request->course_id;

        if ($request->hasFile('file')) {
            $materi->file = $request->file('file')->store('materi_files', 'public');
        }

        $materi->save();

        return redirect()->route('instruktur.dashboard', ['course_id' => $materi->course_id])
            ->with('success', 'Materi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $materi = Materi::findOrFail($id);
        $course = Course::where('instruktur_id', Auth::id())->get();
        return view('instruktur.materi.edit', compact('materi', 'course'));
    }

    public function update(Request $request, $id)
    {
        $materi = Materi::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tipe' => 'required|in:pdf,video,link',
            'file' => 'nullable|file|mimes:pdf,mp4|max:20480',
            'course_id' => 'required|exists:courses,id'
        ]);

        $materi->judul = $request->judul;
        $materi->deskripsi = $request->deskripsi;
        $materi->tipe = $request->tipe;
        $materi->course_id = $request->course_id;

         // Cek apakah ada file diupload
    if ($request->hasFile('file')) {
        // Simpan ke folder 'materi' di storage/app/public/materi
        $file = $request->file('file')->store('materi', 'public');
        $materi->file = $file;
    }

    $materi->save();

    return redirect()->route('instruktur.materi.show', $materi->id)->with('success', 'Materi berhasil diperbarui!');
}

    public function destroy($id)
    {
        $materi = Materi::findOrFail($id);

        if ($materi->file) {
            Storage::disk('public')->delete($materi->file);
        }

        $materi->delete();

        return redirect()->route('instruktur.dashboard', ['course_id' => $materi->course_id])
            ->with('success', 'Materi berhasil dihapus.');
    }

    public function show(Materi $materi)
    {
        return view('instruktur.materi.show', compact('materi'));
    }
}
