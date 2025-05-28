<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index()
    {
        $instruktur = Auth::guard('instruktur')->user();
        $groups = Group::where('instruktur_id', $instruktur->id)->with('course')->get();

        return view('instruktur.groups.index', compact('groups'));
    }

    public function create()
    {
        $instruktur = Auth::guard('instruktur')->user();
        $courses = Course::where('instruktur_id', $instruktur->id)->get();

        return view('instruktur.groups.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'link' => 'required|url'
        ]);

        Group::create([
            'course_id' => $request->course_id,
            'instruktur_id' => Auth::guard('instruktur')->id(),
            'link' => $request->link
        ]);

        return redirect()->route('instruktur.groups.index')->with('success', 'Group berhasil ditambahkan');
    }

    public function edit(Group $group)
    {
        $this->authorize('update', $group);

        $courses = Course::where('instruktur_id', Auth::guard('instruktur')->id())->get();

        return view('instruktur.groups.edit', compact('group', 'courses'));
    }

    public function update(Request $request, Group $group)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'link' => 'required|url'
        ]);

        $group->update([
            'course_id' => $request->course_id,
            'link' => $request->link
        ]);

        return redirect()->route('instruktur.groups.index')->with('success', 'Group berhasil diupdate');
    }

    public function destroy(Group $group)
    {
        $this->authorize('delete', $group);

        $group->delete();
        return redirect()->back()->with('success', 'Group berhasil dihapus');
    }
}