<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use App\Models\Project;  // <-- Tambahkan ini
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        // Ambil project milik instruktur yang login
        $projects = Project::where('instruktur_id', Auth::id())->get();

        // Ambil kelas aktif
        $kelasAktif = Kelas::where('instruktur_id', Auth::id())->first();

        return view('instruktur.project.index', compact('projects', 'kelasAktif'));
    }
}
