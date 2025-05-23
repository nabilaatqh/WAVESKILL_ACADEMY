<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Materi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil kelas pertama yang dipegang instruktur
        $kelasAktif = Kelas::where('instruktur_id', Auth::id())->first();

        // Ambil materi yang terkait dengan kelas instruktur
        $materi = Materi::whereHas('kelas', function ($query) {
            $query->where('instruktur_id', Auth::id());
        })->get();

        // Kirim data ke view
        return view('instruktur.dashboard', compact('kelasAktif', 'materi'));
    }
}
