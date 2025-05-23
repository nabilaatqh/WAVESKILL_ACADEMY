<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Untuk semua view layouts.landing & layouts.student
        View::composer(
            ['layouts.landing', 'layouts.student'],
            fn($view) => $view->with('student', Auth::guard('student')->user())
        );
    }

    // …
}
