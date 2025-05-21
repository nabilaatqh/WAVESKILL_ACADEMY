<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaturanController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.pengaturan.index', compact('admin'));
    }

    public function updateFoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $admin = Auth::guard('admin')->user();

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Simpan di public/images/admin
            $file->move(public_path('images/admin'), $filename);

            // Simpan path relatif ke database (misalnya: images/admin/foto.jpg)
            $admin->foto = 'images/admin/' . $filename;
            $admin->save();
        }

        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui.');
    }
}
