<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman edit profile.
     */
    public function edit()
    {
        $student = Auth::guard('student')->user();
        return view('student.profile.edit', compact('student'));
    }

    /**
     * Update data profile student, termasuk upload foto.
     */
    public function update(Request $request)
    {
        $student = Auth::guard('student')->user();

        $request->validate([
            'first_name'  => 'required|string|max:255',
            'last_name'   => 'nullable|string|max:255',
            'city'        => 'nullable|string|max:255',
            'email'       => 'nullable|email|max:255',
            'about'       => 'nullable|string',
            'phone'       => 'required|string|max:20',
            'birth_place' => 'required|string|max:255',
            'birth_date'  => 'nullable|date_format:Y-m-d',
            'photo'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // validasi foto
        ]);

        // Jika ada upload foto baru
        if ($request->hasFile('photo')) {
            // Hapus file lama jika ada
            if ($student->photo && Storage::exists($student->photo)) {
                Storage::delete($student->photo);
            }

            // Simpan foto baru, simpan pathnya ke DB
            $path = $request->file('photo')->store('public/photos');
            $student->photo = $path;
        }

        // Update field selain foto
        $student->first_name  = $request->first_name;
        $student->last_name   = $request->last_name;
        $student->city        = $request->city;
        $student->email       = $request->email;
        $student->about       = $request->about;
        $student->phone       = $request->phone;
        $student->birth_place = $request->birth_place;
        $student->birth_date  = $request->birth_date;

        $student->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui');
    }
}
