<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use Illuminate\Http\Request;

class PublicJobVacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vacancies = JobVacancy::where('status', 'Open')
                                ->where('deadline', '>=', now()->toDateString())
                                ->latest()
                                ->paginate(9);

        return view('jobs.index', compact('vacancies'));
    }

    /**
     * Display the specified resource.
     */
    public function show(JobVacancy $vacancy)
    {
        // Pastikan hanya lowongan yang aktif yang bisa diakses
        if ($vacancy->status !== 'Open' || $vacancy->deadline < now()->toDateString()) {
            abort(404);
        }

        return view('jobs.show', compact('vacancy'));
    }
}