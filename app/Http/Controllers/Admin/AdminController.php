<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User; // pastikan User sudah import

class AdminController extends Controller
{
    public function index()
    {
        $countInstruktur = User::where('role', 'instructor')->count();
        $countPelajar = User::where('role', 'student')->count();
        $countAdmin = User::where('role', 'admin')->count();

        // Ambil 5 user terbaru berdasarkan last_login_at sebagai aktivitas terbaru
        $latestActivities = User::orderBy('last_login_at', 'desc')
                                ->limit(5)
                                ->get(['name', 'role']);

        return view('admin.dashboard', compact('countInstruktur', 'countPelajar', 'countAdmin', 'latestActivities'));
    }
}
