<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
{
    View::composer('layouts.instruktur', function ($view) {
        $user = Auth::guard('instruktur')->user();

        // Default course aktif
        $course = null;

        if ($user) {
            $course = Course::where('instruktur_id', $user->id)->first(); // atau ambil dari session
        }

        $view->with('selectedCourse', $course);
    });
}}
