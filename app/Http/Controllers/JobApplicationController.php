<?php

namespace App\Http\Controllers;

use App\Notifications\ApplicationStatusUpdated;
use App\Models\JobVacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobApplicationController extends Controller
{
    public function store(Request $request, JobVacancy $vacancy)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 1. Cek apakah user adalah admin
        if ($user->isAdmin()) {
            return back()->with('error', 'Admin tidak dapat melamar pekerjaan.');
        }

        // 2. Cek apakah lowongan masih buka
        if ($vacancy->status !== 'Open' || $vacancy->deadline < now()->toDateString()) {
            return back()->with('error', 'Lowongan ini sudah ditutup.');
        }

        // 3. Cek apakah user sudah pernah melamar
        $alreadyApplied = $user->applications()->where('job_vacancy_id', $vacancy->id)->exists();
        if ($alreadyApplied) {
            return back()->with('error', 'Anda sudah pernah melamar di lowongan ini.');
        }

        // 4. Proses lamaran
        $user->applications()->create([
            'job_vacancy_id' => $vacancy->id,
        ]);

        return back()->with('success', 'Lamaran Anda berhasil dikirim!');
    }

    /**
     * Display a listing of the user's job applications.
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $applications = $user->applications()->with('jobVacancy')->latest()->paginate(10);

        return view('applications.index', compact('applications'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(Request $request, \App\Models\JobApplication $application)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,reviewed,rejected,hired',
        ]);

        $application->update($validated);

        // Kirim notifikasi ke user
        $application->load('user')->user->notify(new ApplicationStatusUpdated($application));

        return back()->with('success', 'Status lamaran berhasil diperbarui.');
    }
}
