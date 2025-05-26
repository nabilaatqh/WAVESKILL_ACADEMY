<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\UserManagementController;

use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\InstructorLoginController;
use App\Http\Controllers\Auth\StudentLoginController;
use App\Http\Controllers\Auth\StudentRegisterController;

use App\Http\Controllers\Instruktur\InstrukturController;
use App\Http\Controllers\Instruktur\MateriController;
use App\Http\Controllers\Instruktur\ProjectController;
use App\Http\Controllers\Instruktur\GroupController;
use App\Http\Controllers\Instruktur\DashboardController;
use App\Http\Controllers\Instruktur\SubmissionController;

use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Student\LandingPageController;
use App\Http\Controllers\Student\certificateController;
use App\Http\Controllers\Student\ProfileController;


// ============== HOME & LOGIN SELECTOR ==============
Route::get('/', fn () => view('welcome'))->name('welcome');

Route::get('/login', function () {
    if (Auth::guard('instruktur')->check()) return redirect()->route('instruktur.dashboard');
    if (Auth::guard('student')->check()) return redirect()->route('student.landingpage');

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
    Route::get('/admin/users', [UserManagementController::class, 'index'])->name('admin.users.index');

    Route::resource('users', UserManagementController::class)->except(['show']);
    Route::patch('users/{user}/toggle', [UserManagementController::class, 'toggleStatus'])->name('users.toggle');
    Route::patch('users/{user}/role', [UserManagementController::class, 'changeRole'])->name('users.role');

    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
    Route::post('/pengaturan/update-foto', [PengaturanController::class, 'updateFoto'])->name('updateFoto');

    Route::resource('course', CourseController::class);


});

// ============== INSTRUKTUR AREA ==============
Route::middleware(['auth:instruktur'])->prefix('instruktur')->name('instruktur.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profil
    Route::get('/profile/edit', [InstrukturController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update', [InstrukturController::class, 'updateProfile'])->name('profile.update');

    // Group (only index)
    Route::get('group', [GroupController::class, 'index'])->name('group.index');

    // Materi CRUD
    Route::get('materi', [MateriController::class, 'index'])->name('materi.index');
    Route::get('materi/create', [MateriController::class, 'create'])->name('materi.create');
    Route::post('materi', [MateriController::class, 'store'])->name('materi.store');
    Route::get('materi/{materi}', [MateriController::class, 'show'])->name('materi.show');
    Route::get('materi/{materi}/edit', [MateriController::class, 'edit'])->name('materi.edit');
    Route::put('materi/{materi}', [MateriController::class, 'update'])->name('materi.update');
    Route::delete('materi/{materi}', [MateriController::class, 'destroy'])->name('materi.destroy');

    // Project CRUD
    Route::get('project', [ProjectController::class, 'index'])->name('project.index');
    Route::get('project/create', [ProjectController::class, 'create'])->name('project.create');
    Route::post('project', [ProjectController::class, 'store'])->name('project.store');
    Route::get('project/{project}', [ProjectController::class, 'show'])->name('project.show');
    Route::get('project/{project}/edit', [ProjectController::class, 'edit'])->name('project.edit');
    Route::put('project/{project}', [ProjectController::class, 'update'])->name('project.update');
    Route::delete('project/{project}', [ProjectController::class, 'destroy'])->name('project.destroy');

    // Submission
    Route::get('/project/{project}/submissions', [SubmissionController::class, 'index'])->name('submission.index');
    Route::get('submission/detail/{submission}', [SubmissionController::class, 'show'])->name('submission.show');
    Route::put('submission/detail/{submission}', [SubmissionController::class, 'update'])->name('submission.update');

    // Log Out
    Route::post('/logout', [InstrukturController::class, 'logout'])->name('logout');
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
