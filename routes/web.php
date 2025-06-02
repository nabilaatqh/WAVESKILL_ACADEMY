<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;

// ADMIN CONTROLLERS
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\EnrollmentController as AdminEnrollmentController;
use App\Http\Controllers\Admin\CourseController;


// AUTH CONTROLLERS
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\InstructorLoginController;
use App\Http\Controllers\Auth\StudentLoginController;
use App\Http\Controllers\Auth\StudentRegisterController;

// INSTRUKTUR CONTROLLERS
use App\Http\Controllers\Instruktur\InstrukturController;
use App\Http\Controllers\Instruktur\MateriController;
use App\Http\Controllers\Instruktur\ProjectController;
use App\Http\Controllers\Instruktur\GroupController as InstrukturGroupController;
use App\Http\Controllers\Instruktur\DashboardController;
use App\Http\Controllers\Instruktur\SubmissionController;

// STUDENT CONTROLLERS
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\courseController as StudentCourseController;
use App\Http\Controllers\Student\LandingPageController;
use App\Http\Controllers\Student\certificateController;
use App\Http\Controllers\Student\ProfileController;
use App\Http\Controllers\Student\EnrollmentController;
use App\Http\Controllers\Student\GroupController as StudentGroupController;
use App\Http\Controllers\Student\StudentCertificateController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;

// ============== HOME & LOGIN SELECTOR ==============
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::get('/login', function () {
    if (Auth::guard('instruktur')->check()) return redirect()->route('instruktur.dashboard');
    if (Auth::guard('student')->check()) return redirect()->route('student.landingpage');
    return view('auth.select_login');
})->name('login');

Route::get('/home', fn () => redirect('/'))->name('home');


// ============== AUTH LOGIN / LOGOUT ROUTES ==============

// === ADMIN ===
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

    // User Management
    Route::resource('users', UserManagementController::class)->except(['show']);
    Route::patch('users/{user}/toggle', [UserManagementController::class, 'toggleStatus'])->name('users.toggle');
    Route::patch('users/{user}/role', [UserManagementController::class, 'changeRole'])->name('users.role');

    // Pengaturan
    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
    Route::post('/pengaturan/update-foto', [PengaturanController::class, 'updateFoto'])->name('updateFoto');

    // Course Management
    Route::resource('course', AdminCourseController::class);

    // Enrollment Verifikasi
    Route::get('/enrollments', [AdminEnrollmentController::class, 'index'])->name('enrollments.index');
    Route::post('/enrollments/{id}/approve', [AdminEnrollmentController::class, 'approve'])->name('enrollments.approve');
    Route::post('/enrollments/{id}/reject', [AdminEnrollmentController::class, 'reject'])->name('enrollments.reject');
});

// ============== INSTRUKTUR AREA ==============
Route::middleware(['auth:instruktur'])->prefix('instruktur')->name('instruktur.')->group(function () {
    

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profil
    Route::get('/profile/edit', [InstrukturController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update', [InstrukturController::class, 'updateProfile'])->name('profile.update');

    // Group (only index)
    Route::get('group', [InstrukturGroupController::class, 'index'])->name('group.index');

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
    Route::get('/submission/detail/{submission}', [SubmissionController::class, 'show'])->name('submission.show');
    Route::put('/submission/detail/{submission}', [SubmissionController::class, 'update'])->name('submission.update');

    // Log Out
    Route::post('/logout', [InstrukturController::class, 'logout'])->name('logout');
});




// ============== STUDENT AREA ==============
Route::middleware(['auth:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
    Route::get('/landingpage', [LandingPageController::class, 'index'])->name('landingpage');
    Route::get('/courses', [StudentCourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/{id}', [StudentCourseController::class, 'show'])->name('courses.detail');
    Route::get('/courses/{id}/enroll', [EnrollmentController::class, 'showEnrollmentForm'])->name('enroll.index');
    Route::post('/courses/{id}/enroll', [EnrollmentController::class, 'processEnrollment'])->name('enroll.process');
    Route::get('/enrollments/status/{id}', [EnrollmentController::class, 'enrollmentStatus'])->name('enroll.status');
    Route::get('/groups', [StudentGroupController::class, 'index'])->name('groups.index');

    // Profil
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // sertifikat
    Route::get('/certificates', [StudentCertificateController::class, 'index'])->name('certificates.index');
    Route::get('/certificates/{course}', [StudentCertificateController::class, 'show'])->name('certificates.show');
    Route::get('/certificate/{course}', [StudentCertificateController::class, 'download'])->name('certificate.download');

});


// ============== LOGOUT MASSAL ==============
Route::get('/force-logout-all', function () {
    Auth::guard('web')->logout();
    Auth::guard('admin')->logout();
    Auth::guard('instruktur')->logout();
    Auth::guard('student')->logout();
    Session::flush();
    return 'Logout semua selesai, silakan login ulang.';
});
