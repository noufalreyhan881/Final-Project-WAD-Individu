<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // Pastikan user yang diakses bukan admin
        if ($user->isAdmin()) {
            abort(404);
        }

        // Eager load the profile
        $user->load('profile');

        return view('admin.applicants.show', compact('user'));
    }
}
