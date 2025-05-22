<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:instruktur')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.instruktur.login'); // Pastikan view ini ada
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('instruktur')->attempt($credentials, $request->filled('remember'))) {
            return redirect()->intended(route('instruktur.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email', 'remember'));
    }

    public function logout(Request $request)
    {
        Auth::guard('instruktur')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('instruktur.login');
    }
}
