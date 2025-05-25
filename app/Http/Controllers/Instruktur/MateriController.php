<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function index(Request $request)
    {
        $query = Materi::whereHas('kelas', function ($q) {
            $q->where('instruktur_id', Auth::id());
        });

        if ($request->kelas_id) {
            $query->where('kelas_id', $request->kelas_id);
        }

        $materi = $query->latest()->get();
        $kelasList = Kelas::where('instruktur_id', Auth::id())->get();

        return view('instruktur.materi.index', compact('materi', 'kelasList'));
    }

    public function create(Kelas $kelas)
    {
        if ($kelas->instruktur_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return view('instruktur.materi.create', compact('kelas'));
    }

    public function store(Request $request, Kelas $kelas)
    {
        if ($kelas->instruktur_id !== Auth::id()) {
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
            'kelas_id' => $kelas->id,
        ]);

        return redirect()->route('instruktur.materi.index')->with('success', 'Materi berhasil ditambahkan.');
    }

    public function show(Materi $materi)
    {
        if ($materi->kelas->instruktur_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return view('instruktur.materi.show', compact('materi'));
    }

    public function edit(Materi $materi)
    {
        if ($materi->kelas->instruktur_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $kelasList = Kelas::where('instruktur_id', Auth::id())->get();

        return view('instruktur.materi.edit', compact('materi', 'kelasList'));
    }

    public function update(Request $request, Materi $materi)
    {
        if ($materi->kelas->instruktur_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,docx,pptx,mp4|max:20480',
            'kelas_id' => 'required|exists:kelas,id',
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
        $materi->kelas_id = $request->kelas_id;
        $materi->save();

        return redirect()->route('instruktur.materi.index')->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy(Materi $materi)
    {
        if ($materi->kelas->instruktur_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        if ($materi->file_path && Storage::disk('public')->exists($materi->file_path)) {
            Storage::disk('public')->delete($materi->file_path);
        }

        $materi->delete();

        return redirect()->route('instruktur.materi.index')->with('success', 'Materi berhasil dihapus.');
    }
}
