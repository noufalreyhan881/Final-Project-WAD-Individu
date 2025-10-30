<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Public Job Vacancy Routes
Route::get('/lowongan', [\App\Http\Controllers\PublicJobVacancyController::class, 'index'])->name('jobs.index');
Route::get('/lowongan/{vacancy}', [\App\Http\Controllers\PublicJobVacancyController::class, 'show'])->name('jobs.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/applicant', [ProfileController::class, 'updateApplicantProfile'])->name('profile.update.applicant');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Job Application Route
    Route::post('/lowongan/{vacancy}/apply', [\App\Http\Controllers\JobApplicationController::class, 'store'])->name('jobs.apply');

    // User's Job Applications List
    Route::get('/my-applications', [\App\Http\Controllers\JobApplicationController::class, 'index'])->name('applications.index');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return '<h1>Welcome to Admin Dashboard</h1>'; // Halaman sementara
    })->name('dashboard');

    // CRUD routes for Job Vacancies
    Route::resource('vacancies', \App\Http\Controllers\JobVacancyController::class);
});


require __DIR__.'/auth.php';
