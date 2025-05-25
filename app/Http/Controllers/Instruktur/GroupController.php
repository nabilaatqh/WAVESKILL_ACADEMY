<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;

class GroupController extends Controller
{
    /**
     * Tampilkan daftar course yang memiliki link grup WhatsApp.
     */
    public function index()
    {
        $instruktur = Auth::guard('instruktur')->user();

        // Ambil semua course milik instruktur yang memiliki grup WhatsApp
        $course = Course::where('instruktur_id', $instruktur->id)
            ->whereNotNull('whatsapp_link')
            ->get();

        return view('instruktur.group.index', compact('course'));
    }
}