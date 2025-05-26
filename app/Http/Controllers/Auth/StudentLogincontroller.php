<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:student')->except('logout');
    }

    /**
     * Tampilkan form login student.
     */
    public function showLoginForm()
    {
        return view('auth.student.login'); // Pastikan view ini ada
    }

    /**
     * Proses login student.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('student')->attempt($credentials, $request->filled('remember'))) {
            return redirect()->intended(route('student.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah, atau bukan akun student.',
        ])->withInput($request->only('email'));
    }

    /**
     * Logout student.
     */
    public function logout()
    {
        Auth::guard('student')->logout();
        return redirect()->route('student.login')->with('success', 'Kamu sudah logout.');
    }
}