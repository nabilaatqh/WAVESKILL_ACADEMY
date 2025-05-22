<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Kelas;
use App\Models\Materi;
use App\Models\Project;

class InstructorController extends Controller
{
    public function index(): View
    {
        $instrukturId = Auth::id();

        $kelas = Kelas::where('instruktur_id', $instrukturId)->get();

        $materi = Materi::whereHas('kelas', function ($q) use ($instrukturId) {
            $q->where('instruktur_id', $instrukturId);
        })->latest()->get();

        $projects = Project::whereHas('kelas', function ($q) use ($instrukturId) {
            $q->where('instruktur_id', $instrukturId);
        })->latest()->get();

        return view('instruktur.dashboard', compact('kelas', 'materi', 'projects'));
    }

public function editProfile()
{
    return view('instruktur.profile.edit');
}

public function updateProfile(Request $request)
{
    $instruktur = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $instruktur->id,
        'password' => 'nullable|min:6',
    ]);

    $instruktur->name = $request->name;
    $instruktur->email = $request->email;

    if ($request->filled('password')) {
        $instruktur->password = Hash::make($request->password);
    }

    $instruktur->save();

    return redirect()->route('instruktur.profile.edit')->with('success', 'Profil berhasil diperbarui.');
}

}
