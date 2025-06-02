<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class StudentRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.student.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        // ✅ Buat user
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => 'student',
            'is_active' => true,
        ]);

        // ✅ Trigger email verifikasi
        event(new Registered($user));

        // ✅ Login otomatis
        Auth::guard('student')->login($user);

        // ✅ Redirect ke halaman verifikasi
        return redirect()->route('verification.notice');
    }
}
