<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// AUTH CONTROLLERS
use App\Http\Controllers\Auth\AdminLoginController;

// Student
use App\Http\Controllers\Auth\StudentLoginController;
use App\Http\Controllers\Auth\StudentRegisterController;

// ADMIN CONTROLLERS
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserManagementController;

// INSTRUKTUR CONTROLLERS
use App\Http\Controllers\Instruktur\InstructorController;
use App\Http\Controllers\Instruktur\MateriController;
use App\Http\Controllers\Instruktur\ProjectController;
use App\Http\Controllers\Instruktur\KelasController;
use App\Http\Controllers\Instruktur\GroupController;
use App\Http\Controllers\Auth\InstructorLoginController;

// STUDENT CONTROLLERS
use App\Http\Controllers\Student\StudentController;

//
// ============== HOME & LOGIN SELECTOR ==============
//
Route::get('/', fn () => view('welcome'))->name('welcome');

Route::get('/login', function () {
    if (Auth::guard('instruktur')->check()) {
        return redirect()->route('instruktur.dashboard');
    }
    if (Auth::guard('student')->check()) {
        return redirect()->route('student.dashboard');
    }
    return view('auth.select_login');
})->name('login');

Route::get('/home', fn () => redirect('/'))->name('home');


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


// ============== ADMIN AREA ==============
//
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // User Management Manual Routes
    Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserManagementController::class, 'create'])->name('users.create');
    Route::post('/users', [UserManagementController::class, 'store'])->name('users.store');
    Route::get('/users/{role}/{id}/edit', [UserManagementController::class, 'edit'])->name('users.edit');
    Route::put('/users/{role}/{id}', [UserManagementController::class, 'update'])->name('users.update');
    Route::delete('/users/{role}/{id}', [UserManagementController::class, 'destroy'])->name('users.destroy');
});


//
// ============== INSTRUKTUR AREA ==============
//
Route::middleware(['auth:instruktur'])->prefix('instruktur')->name('instruktur.')->group(function () {
    Route::get('/dashboard', [InstructorController::class, 'index'])->name('dashboard');

    // Materi resource (except create & store karena ada kelas sebagai parameter)
    Route::resource('materi', MateriController::class)->except(['create', 'store']);

    // Materi create & store harus bawa parameter kelas
    Route::get('/kelas/{kelas}/materi/create', [MateriController::class, 'create'])->name('materi.create');
    Route::post('/kelas/{kelas}/materi', [MateriController::class, 'store'])->name('materi.store');

    Route::resource('projects', ProjectController::class);
    // Projects CRUD (gunakan bentuk jamak/plural)
    Route::resource('projects', ProjectController::class)->names([
        'index' => 'project.index',
        'create' => 'project.create',
        'store' => 'project.store',
        'show' => 'project.show',
        'edit' => 'project.edit',
        'update' => 'project.update',
        'destroy' => 'project.destroy',
    ]);

    // Group CRUD (lengkap)
    Route::get('/group', [GroupController::class, 'index'])->name('group.index');
    Route::get('/group/create', [GroupController::class, 'create'])->name('group.create');
    Route::post('/group', [GroupController::class, 'store'])->name('group.store');
    Route::get('/group/{group}/edit', [GroupController::class, 'edit'])->name('group.edit');
    Route::put('/group/{group}', [GroupController::class, 'update'])->name('group.update');
    Route::delete('/group/{group}', [GroupController::class, 'destroy'])->name('group.destroy');

    // Kelas CRUD
    Route::resource('kelas', KelasController::class);

    // Profile edit & update manual routes
    Route::get('/profile/edit', [InstructorController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update', [InstructorController::class, 'updateProfile'])->name('profile.update');
});

// ============== STUDENT AREA ==============
//
Route::middleware(['auth:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'index'])->name('dashboard');
});
