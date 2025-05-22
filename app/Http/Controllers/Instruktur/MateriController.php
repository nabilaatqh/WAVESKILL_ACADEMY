<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MateriController extends Controller
{
    public function index()
{
    $materi = Materi::whereHas('kelas', function ($q) {
        $q->where('instruktur_id', Auth::id());
    })->latest()->get();

    $kelasAktif = Kelas::where('instruktur_id', Auth::id())->first(); // contoh kelas aktif

    return view('instruktur.materi.index', compact('materi', 'kelasAktif'));
}


    public function create(Kelas $kelas)
    {
        // Pastikan kelas milik instruktur ini
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

    // Tambahkan method show() untuk menghindari error dari Route::resource
    public function show(Materi $materi)
    {
        // Pastikan materi milik instruktur yang sedang login
        if ($materi->kelas->instruktur_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return view('instruktur.materi.show', compact('materi'));
    }

    // Method edit() untuk form edit materi
    public function edit(Materi $materi)
    {
        if ($materi->kelas->instruktur_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        // Ambil kelas milik instruktur untuk dropdown jika perlu
        $kelasList = Kelas::where('instruktur_id', Auth::id())->get();

        return view('instruktur.materi.edit', compact('materi', 'kelasList'));
    }

    // Method update() untuk proses update materi
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
            $filePath = $request->file('file')->store('materi_files', 'public');
            $materi->file_path = $filePath;
        }

        $materi->judul = $request->judul;
        $materi->deskripsi = $request->deskripsi;
        $materi->kelas_id = $request->kelas_id;
        $materi->save();

        return redirect()->route('instruktur.materi.index')->with('success', 'Materi berhasil diperbarui.');
    }

    // Method destroy() untuk hapus materi
    public function destroy(Materi $materi)
    {
        if ($materi->kelas->instruktur_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $materi->delete();

        return redirect()->route('instruktur.materi.index')->with('success', 'Materi berhasil dihapus.');
    }
}
