<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Materi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil course pertama yang dipegang instruktur
        $courseAktif = Course::where('instruktur_id', Auth::id())->first();

        // Ambil materi yang terkait dengan course instruktur
        $materi = Materi::whereHas('course', function ($query) {
            $query->where('instruktur_id', Auth::id());
        })->get();

        // Kirim data ke view
        return view('instruktur.dashboard', compact('courseAktif', 'materi'));
    }
}
