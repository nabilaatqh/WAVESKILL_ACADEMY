<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Admin
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Auth\AdminLoginController;

// Instruktur
use App\Http\Controllers\Instruktur\DashboardController;
use App\Http\Controllers\Instruktur\KelasController;
use App\Http\Controllers\Instruktur\MateriController;
use App\Http\Controllers\Instruktur\ProjectController;
use App\Http\Controllers\Auth\InstructorLoginController;

// Student
use App\Http\Controllers\Auth\StudentLoginController;
use App\Http\Controllers\Auth\StudentRegisterController;
use App\Http\Controllers\Student\StudentController;

//
// ============== HOME & LOGIN SELECTOR ==============
//
Route::get('/', fn () => view('welcome'))->name('welcome');

Route::get('/login', function () {
    if (Auth::guard('instruktur')->check()) return redirect()->route('instruktur.dashboard');
    if (Auth::guard('student')->check()) return redirect()->route('student.dashboard');
    return view('auth.select_login');
})->name('login');

Route::get('/home', fn () => redirect('/'))->name('home');


//
// ============== AUTH LOGIN / LOGOUT ROUTES ==============
//

// ADMIN
Route::get('/admin', [AdminLoginController::class, 'showLoginForm']);
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login']);
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

// INSTRUKTUR
Route::get('/instruktur/login', [InstructorLoginController::class, 'showLoginForm'])->name('instruktur.login');
Route::post('/instruktur/login', [InstructorLoginController::class, 'login']);
Route::post('/instruktur/logout', [InstructorLoginController::class, 'logout'])->name('instruktur.logout');

// STUDENT
Route::get('/student/login', [StudentLoginController::class, 'showLoginForm'])->name('student.login');
Route::post('/student/login', [StudentLoginController::class, 'login']);
Route::post('/student/logout', [StudentLoginController::class, 'logout'])->name('student.logout');

Route::get('/student/register', [StudentRegisterController::class, 'showRegistrationForm'])->name('student.register');
Route::post('/student/register', [StudentRegisterController::class, 'register']);


//
// ============== ADMIN AREA ==============
//
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Manajemen User
    Route::resource('users', UserManagementController::class)->except(['show']);
    Route::patch('users/{user}/toggle', [UserManagementController::class, 'toggleStatus'])->name('users.toggle');
    Route::patch('users/{user}/role', [UserManagementController::class, 'changeRole'])->name('users.role');
});


//
// ============== INSTRUKTUR AREA ==============
//
Route::middleware(['auth:instruktur'])->prefix('instruktur')->name('instruktur.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('kelas', KelasController::class);
    Route::resource('materi', MateriController::class);
    Route::resource('project', ProjectController::class);
    Route::get('materi/{materi}', [MateriController::class, 'show'])->name('materi.show');

});


//
// ============== STUDENT AREA ==============
//
Route::middleware(['auth:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'index'])->name('dashboard');
    // Tambah route lainnya di sini: kursus, materi, tugas, forum, profil, dll
});
