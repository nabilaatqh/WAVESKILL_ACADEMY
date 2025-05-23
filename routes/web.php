<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\InstructorLoginController;
use App\Http\Controllers\Auth\StudentLoginController;
use App\Http\Controllers\Auth\StudentRegisterController;
use App\Http\Controllers\Instructor\InstructorController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\LandingPageController;
use App\Http\Controllers\Student\CourseController;
use App\Http\Controllers\Student\groupController;
use App\Http\Controllers\Student\certificateController;
use App\Http\Controllers\Student\ProfileController;


// ============== HOME & LOGIN SELECTOR ==============
Route::get('/', fn () => view('welcome'))->name('welcome');

Route::get('/login', function () {
    // Jika sudah login, arahkan langsung ke dashboard sesuai role
    if (Auth::guard('instruktur')->check()) return redirect()->route('instruktur.dashboard');
    if (Auth::guard('student')->check()) return redirect()->route('student.landingpage');

    // Tampilkan halaman pemilih login Instruktur/Mahasiswa (tanpa admin)
    return view('auth.select_login');
})->name('login');

Route::get('/home', fn () => redirect('/'))->name('home');


// ============== AUTH LOGIN / LOGOUT ROUTES ==============

// === ADMIN ===
Route::get('/admin', [AdminLoginController::class, 'showLoginForm']);
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login']);
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

// === INSTRUKTUR ===
Route::get('/instruktur/login', [InstructorLoginController::class, 'showLoginForm'])->name('instruktur.login');
Route::post('/instruktur/login', [InstructorLoginController::class, 'login']);
Route::post('/instruktur/logout', [InstructorLoginController::class, 'logout'])->name('instruktur.logout');

// === STUDENT ===
Route::get('/student/login', [StudentLoginController::class, 'showLoginForm'])->name('student.login');
Route::post('/student/login', [StudentLoginController::class, 'login']);
Route::post('/student/logout', [StudentLoginController::class, 'logout'])->name('student.logout');

Route::get('/student/register', [StudentRegisterController::class, 'showRegistrationForm'])->name('student.register');
Route::post('/student/register', [StudentRegisterController::class, 'register']);


// ============== ADMIN AREA ==============
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Manajemen User
    Route::resource('users', UserManagementController::class)->except(['show']);
    Route::patch('users/{user}/toggle', [UserManagementController::class, 'toggleStatus'])->name('users.toggle');
    Route::patch('users/{user}/role', [UserManagementController::class, 'changeRole'])->name('users.role');
});


// ============== INSTRUKTUR AREA ==============
Route::middleware(['auth:instruktur'])->prefix('instruktur')->name('instruktur.')->group(function () {
    Route::get('/dashboard', [InstructorController::class, 'index'])->name('dashboard');
    // Tambah: kursus, materi, tugas, dll
});


// ============== STUDENT AREA ==============
Route::middleware(['auth:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'index'])->name('dashboard');
    Route::get('/landingpage', [LandingPageController::class, 'index'])->name('landingpage');
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');
    Route::get('/groups', [groupController::class, 'index'])->name('groups.index');
    Route::get('/certificates', [certificateController::class, 'index'])->name('certificates.index');
    Route::get('/certificates/{course}', [CertificateController::class, 'show'])->name('certificates.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    // Tambah: daftar kursus, materi, tugas, forum, profil, dll
});
