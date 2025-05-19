<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Materi;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;

class MateriController extends Controller
{
    public function index(Request $request)
    {
    $kelasId = $request->query('kelas');

    if ($kelasId) {
        $materi = Materi::where('kelas_id', $kelasId)->latest()->get();
        $kelas = \App\Models\Kelas::find($kelasId);
    } else {
        $materi = Materi::latest()->get();
        $kelas = null;
    }

    return view('instruktur.materi.index', compact('materi', 'kelas'));
    }


    public function create()
    {
    $instruktur = Auth::guard('instruktur')->user();
    $kelasAktif = Kelas::where('instruktur_id', $instruktur->id)->latest()->first();

    if (!$kelasAktif) {
        return redirect()->route('instruktur.dashboard')->with('error', 'Tidak ada kelas aktif untuk mengunggah materi.');
    }

    return view('instruktur.materi.create', compact('kelasAktif'));
    }


    public function store(Request $request)
{
    $instruktur = Auth::guard('instruktur')->user();
    $kelasAktif = Kelas::where('instruktur_id', $instruktur->id)->latest()->first();

    if (!$kelasAktif) {
        return redirect()->route('instruktur.dashboard')->with('error', 'Tidak ada kelas aktif untuk menyimpan materi.');
    }

    $data = $request->validate([
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'file' => 'nullable|file|max:10240',
    ]);

    // Tambahkan kelas_id dari kelas aktif
    $data['kelas_id'] = $kelasAktif->id;

    if ($request->hasFile('file')) {
        $data['file'] = $request->file('file')->store('materi', 'public');
    }

    Materi::create($data);
    return redirect()->route('instruktur.materi.index')->with('success', 'Materi berhasil ditambahkan.');
}


    public function edit(Materi $materi)
    {
        $kelas = Kelas::all();
        return view('instruktur.materi.edit', compact('materi', 'kelas'));
    }

    public function update(Request $request, Materi $materi)
    {
        $data = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'file' => 'nullable|file|max:10240',
        ]);

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('materi', 'public');
        }

        $materi->update($data);
        $this->authorize('update', $materi);
        return redirect()->route('instruktur.materi.index')->with('success', 'Materi berhasil diperbarui.');
    }

    public function show(Materi $materi)
    {
    $this->authorize('view', $materi); // optional jika pakai policy
    return view('instruktur.materi.show', compact('materi'));
    }


    public function destroy(Materi $materi)
    {
        $materi->delete();
        return redirect()->route('instruktur.materi.index')->with('success', 'Materi berhasil dihapus.');
    }
}
