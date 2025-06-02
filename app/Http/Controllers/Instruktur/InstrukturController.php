<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class InstrukturController extends Controller
{
    // Tampilkan dashboard dengan course dan materi
    public function dashboard()
    {
        $courseAktif = Course::where('instruktur_id', Auth::id())->first();

        $materi = Materi::whereHas('course', function ($query) {
            $query->where('instruktur_id', Auth::id());
        })->get();

        return view('instruktur.dashboard', compact('courseAktif', 'materi'));
    }

    // Tampilkan form edit profil
    public function editProfile()
    {
        $instruktur = Auth::user();
        return view('instruktur.profile.edit', compact('instruktur'));
    }

    public function updateProfile(Request $request)
    {
        $instruktur = Auth::user();

        $request->validate([
            'nama_awal' => ['required', 'string', 'max:255'],
            'nama_akhir' => ['nullable', 'string', 'max:255'],
            'domisili' => ['nullable', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($instruktur->id),
            ],
            'tentang_saya' => ['nullable', 'string'],
            'telepon' => ['required', 'string', 'max:20'],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        // Simpan data biasa
        $instruktur->fill($request->only([
            'nama_awal', 'nama_akhir', 'domisili', 'email',
            'tentang_saya', 'telepon', 'tempat_lahir', 'tanggal_lahir'
        ]));

        // Simpan file foto jika ada
        if ($request->hasFile('foto')) {
            if ($instruktur->foto && \Storage::disk('public')->exists($instruktur->foto)) {
                \Storage::disk('public')->delete($instruktur->foto);
            }

            $file = $request->file('foto');
            $path = $file->store('foto_instruktur', 'public');
            $instruktur->foto = $path;
        }

        $instruktur->save();

        return redirect()->route('instruktur.profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }

    // Method logout
    public function logout(Request $request)
    {
        Auth::guard('instruktur')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
