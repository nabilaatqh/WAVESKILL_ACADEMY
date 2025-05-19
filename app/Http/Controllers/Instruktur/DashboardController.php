<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Kelas;

class DashboardController extends Controller
{
    public function index()
{
    $instruktur = Auth::guard('instruktur')->user();

    $kelasAktif = Kelas::where('instruktur_id', $instruktur->id)->latest()->first();
    $kelasList = Kelas::where('instruktur_id', $instruktur->id)
                    ->where('id', '!=', optional($kelasAktif)->id)
                    ->get();

    // Ambil materi dari kelas aktif (relasi harus benar)
    $materis = $kelasAktif ? $kelasAktif->materi()->latest()->get() : collect();
     $projects = $kelasAktif ? $kelasAktif->project()->latest()->get() : collect(); // ✅ Tambahkan ini

    return view('instruktur.dashboard', compact(
        'instruktur', 'kelasAktif', 'kelasList', 'materis', 'projects'
    ));
}}