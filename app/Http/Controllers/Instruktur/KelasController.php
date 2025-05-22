<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::where('instruktur_id', Auth::id())->latest()->get();
        return view('instruktur.kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('instruktur.kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only('nama_kelas', 'deskripsi');
        $data['instruktur_id'] = Auth::id();

        if ($request->hasFile('banner')) {
            $data['banner'] = $request->file('banner')->store('kelas_banner', 'public');
        }

        Kelas::create($data);
        return redirect()->route('instruktur.kelas.index')->with('success', 'Kelas berhasil dibuat.');
    }

    public function edit(Kelas $kelas)
    {
        $this->authorize('update', $kelas);
        return view('instruktur.kelas.edit', compact('kelas'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        $this->authorize('update', $kelas);

        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only('nama_kelas', 'deskripsi');

        if ($request->hasFile('banner')) {
            if ($kelas->banner) {
                Storage::disk('public')->delete($kelas->banner);
            }
            $data['banner'] = $request->file('banner')->store('kelas_banner', 'public');
        }

        $kelas->update($data);
        return redirect()->route('instruktur.kelas.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy(Kelas $kelas)
    {
        $this->authorize('delete', $kelas);

        if ($kelas->banner) {
            Storage::disk('public')->delete($kelas->banner);
        }

        $kelas->delete();
        return redirect()->route('instruktur.kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }
}