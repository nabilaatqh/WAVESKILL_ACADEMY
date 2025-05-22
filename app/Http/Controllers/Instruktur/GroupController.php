<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index()
    {
        // Ambil grup milik instruktur yang sedang login
        $groups = Group::where('instruktur_id', Auth::id())->get();

        return view('instruktur.group.index', compact('groups'));
    }

    public function create()
    {
        return view('instruktur.group.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'whatsapp_link' => 'required|url',
        ]);

        Group::create([
            'kelas_id' => $request->kelas_id,
            'whatsapp_link' => $request->whatsapp_link,
            'instruktur_id' => Auth::id(),
        ]);

        return redirect()->route('instruktur.group.index')->with('success', 'Group berhasil ditambahkan.');
    }

    public function edit(Group $group)
    {
        // Pastikan group milik instruktur yang login
        if ($group->instruktur_id !== Auth::id()) {
            abort(403);
        }

        return view('instruktur.group.edit', compact('group'));
    }

    public function update(Request $request, Group $group)
    {
        if ($group->instruktur_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'whatsapp_link' => 'required|url',
        ]);

        $group->update([
            'kelas_id' => $request->kelas_id,
            'whatsapp_link' => $request->whatsapp_link,
        ]);

        return redirect()->route('instruktur.group.index')->with('success', 'Group berhasil diperbarui.');
    }

    public function destroy(Group $group)
    {
        if ($group->instruktur_id !== Auth::id()) {
            abort(403);
        }

        $group->delete();

        return redirect()->route('instruktur.group.index')->with('success', 'Group berhasil dihapus.');
    }
}
