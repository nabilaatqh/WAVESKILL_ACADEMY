<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller; 
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class InstructorController extends Controller
{
    public function index(): Factory|View
    {
        return view('instructor.dashboard');
    }
}
