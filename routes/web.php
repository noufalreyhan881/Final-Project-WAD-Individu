<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/applicant', [ProfileController::class, 'updateApplicantProfile'])->name('profile.update.applicant');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
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
