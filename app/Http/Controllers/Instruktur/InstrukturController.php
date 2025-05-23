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

        // Validasi input sesuai field form
        $request->validate([
            'nama_awal' => ['required', 'string', 'max:255'],
            'nama_akhir' => ['nullable', 'string', 'max:255'],
            'domisili' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($instruktur->id)],
            'tentang_saya' => ['nullable', 'string'],
            'telepon' => ['required', 'string', 'max:20'],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'], // optional password
        ]);

        // Update data profil
        $instruktur->nama_awal = $request->nama_awal;
        $instruktur->nama_akhir = $request->nama_akhir;
        $instruktur->domisili = $request->domisili;
        $instruktur->email = $request->email;
        $instruktur->tentang_saya = $request->tentang_saya;
        $instruktur->telepon = $request->telepon;
        $instruktur->tempat_lahir = $request->tempat_lahir;
        $instruktur->tanggal_lahir = $request->tanggal_lahir;

        // Jika password diisi, hash dan update
        if ($request->filled('password')) {
            $instruktur->password = Hash::make($request->password);
        }

        $instruktur->save();

        return redirect()->route('instruktur.profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }

}
