<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use App\Models\Course;

class GroupController extends Controller
{
    public function index()
    {
        $instruktur = Auth::guard('instruktur')->user();

        // 1) Semua Group yang dibuat instruktur ini
        $groups = Group::where('instruktur_id', $instruktur->id)
                       ->with('course')
                       ->get();

        // 2) Semua Course yang punya whatsapp_link
        $coursesWithLink = Course::where('instruktur_id', $instruktur->id)
                                 ->whereNotNull('whatsapp_link')
                                 ->get();

        return view('instruktur.groups.index', compact('groups', 'coursesWithLink'));
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
            'link'      => 'required|url',
        ]);

        Group::create([
            'course_id'     => $request->course_id,
            'instruktur_id' => Auth::guard('instruktur')->id(),
            'link'          => $request->link,
        ]);

        return redirect()
            ->route('instruktur.groups.index')
            ->with('success', 'Group berhasil ditambahkan');
    }

    // ... show, edit, update, destroy seperti sebelumnya
}
