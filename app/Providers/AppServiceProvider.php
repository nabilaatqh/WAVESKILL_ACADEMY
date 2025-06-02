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
        // View composer untuk layout instruktur
        View::composer('layouts.instruktur', function ($view) {
            $user = Auth::guard('instruktur')->user();

            $course = null;
            if ($user) {
                // Ambil course pertama milik instruktur yang login
                $course = Course::where('instruktur_id', $user->id)->first();
            }

            $view->with('selectedCourse', $course);
        });

        // View composer untuk layout student
        View::composer('layouts.student', function ($view) {
            $student = Auth::guard('student')->user();
            $view->with('student', $student);
        });
    }
}
