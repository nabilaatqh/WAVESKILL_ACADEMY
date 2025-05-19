<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller; // ← ini yang kurang
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class InstructorController extends Controller
{
    public function index(): Factory|View
    {
        return view('instructor.dashboard');
    }
}
