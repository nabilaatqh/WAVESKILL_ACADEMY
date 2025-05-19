<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kelas;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::where('instruktur_id', Auth::id())->get();
        return view('instruktur.kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('instruktur.kelas.create');
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'nama' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'banner' => 'required|image|max:2048',
    ]);

    $data['instruktur_id'] = Auth::guard('instruktur')->id();
    $data['banner'] = $request->file('banner')->store('kelas_banner', 'public');

    Kelas::create($data);

    return redirect()->route('instruktur.kelas.index')->with('success', 'Kelas berhasil dibuat.');
}


    public function edit(Kelas $kela)
    {
        $this->authorize('update', $kela);
        return view('instruktur.kelas.edit', ['kelas' => $kela]);
    }

    public function update(Request $request, Kelas $kela)
    {
        $this->authorize('update', $kela);

        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'banner' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('banner')) {
            $data['banner'] = $request->file('banner')->store('kelas', 'public');
        }

        $kela->update($data);
        return redirect()->route('instruktur.kelas.index')->with('success', 'Kelas diperbarui.');
    }

    public function destroy(Kelas $kela)
    {
        $this->authorize('delete', $kela);
        $kela->delete();
        return redirect()->route('instruktur.kelas.index')->with('success', 'Kelas dihapus.');
    }
}
