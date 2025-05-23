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
    // Menampilkan daftar materi berdasarkan course
    public function index()
    {
        $user = Auth::user();
        $courses = Course::where('instruktur_id', $user->id)->get();
        return view('instruktur.materi.index', compact('courses'));
    }

    // Form tambah materi baru
    public function create()
    {
        $courses = Course::where('instruktur_id', Auth::id())->get();
        return view('instruktur.materi.create', compact('courses'));
    }

    // Simpan materi baru
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
            $materi->file = $request->file('file')->store('materi');
        }

        $materi->save();

        return redirect()->route('materi.index')->with('success', 'Materi berhasil ditambahkan.');
    }

    // Form edit materi
    public function edit($id)
    {
        $materi = Materi::findOrFail($id);
        $courses = Course::where('instruktur_id', Auth::id())->get();
        return view('instruktur.materi.edit', compact('materi', 'courses'));
    }

    // Update materi
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

        if ($request->hasFile('file')) {
            if ($materi->file) {
                Storage::delete($materi->file);
            }
            $materi->file = $request->file('file')->store('materi');
        }

        $materi->save();

        return redirect()->route('materi.index')->with('success', 'Materi berhasil diperbarui.');
    }

    // Hapus materi
    public function destroy($id)
    {
        $materi = Materi::findOrFail($id);
        if ($materi->file) {
            Storage::delete($materi->file);
        }
        $materi->delete();
        return redirect()->route('materi.index')->with('success', 'Materi berhasil dihapus.');
    }
}
