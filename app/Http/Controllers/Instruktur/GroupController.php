<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instruktur = Auth::guard('instruktur')->user();
        $groups = Group::where('instruktur_id', $instruktur->id)
                       ->with('course')
                       ->get();

        return view('instruktur.groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $instruktur = Auth::guard('instruktur')->user();
        $courses = Course::where('instruktur_id', $instruktur->id)->get();

        return view('instruktur.groups.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'link'      => 'required|url',
        ]);

        Group::create([
            'course_id'      => $request->course_id,
            'instruktur_id'  => Auth::guard('instruktur')->id(),
            'link'           => $request->link,
        ]);

        return redirect()
            ->route('instruktur.groups.index')
            ->with('success', 'Group berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        $this->authorize('view', $group);

        return view('instruktur.groups.show', compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        $this->authorize('update', $group);

        $courses = Course::where('instruktur_id', Auth::guard('instruktur')->id())->get();

        return view('instruktur.groups.edit', compact('group', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $group)
    {
        $this->authorize('update', $group);

        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'link'      => 'required|url',
        ]);

        $group->update([
            'course_id' => $request->course_id,
            'link'      => $request->link,
        ]);

        return redirect()
            ->route('instruktur.groups.index')
            ->with('success', 'Group berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        $this->authorize('delete', $group);

        $group->delete();

        return redirect()
            ->route('instruktur.groups.index')
            ->with('success', 'Group berhasil dihapus');
    }
}
