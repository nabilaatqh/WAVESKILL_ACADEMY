<?php

  namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Kelas;
use App\Models\Materi;

class DashboardController extends Controller
{
    public function index(): View
    {
        $instrukturId = Auth::id();

        $kelas = Kelas::where('instruktur_id', $instrukturId)->get();

        $materi = Materi::whereHas('kelas', function ($q) use ($instrukturId) {
            $q->where('instruktur_id', $instrukturId);
        })->latest()->get();

        return view('instruktur.dashboard', compact('kelas', 'materi'));
    }
}