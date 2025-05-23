<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Materi;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard instruktur dengan daftar course, materi dan project.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Ambil semua course yang dimiliki instruktur
        $courses = Course::where('instruktur_id', $user->id)->get();

        // Tentukan course yang dipilih, default ke course pertama
        $selectedCourseId = $request->input('course_id') ?? ($courses->first()->id ?? null);

        $selectedCourse = $selectedCourseId ? Course::find($selectedCourseId) : null;

        // Ambil materi & project dari course yang dipilih
        $materi = $selectedCourse ? $selectedCourse->materis : collect();
        $projects = $selectedCourse ? $selectedCourse->projects : collect();

        return view('instruktur.dashboard', compact('courses', 'selectedCourse', 'materi', 'projects'));
    }
}
