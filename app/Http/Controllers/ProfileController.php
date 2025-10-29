<?php

namespace App\Http\Controllers;

use App\Models\ApplicantProfile;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // Eager load the profile relationship
        $request->user()->load('profile');

        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update the user's applicant profile information.
     */
    public function updateApplicantProfile(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nomor_ktp' => ['nullable', 'string', 'max:16'],
            'tempat_lahir' => ['nullable', 'string', 'max:255'],
            'tanggal_lahir' => ['nullable', 'date'],
            'jenis_kelamin' => ['nullable', 'in:Laki-laki,Perempuan'],
            'alamat_lengkap' => ['nullable', 'string'],
            'nomor_telepon' => ['nullable', 'string', 'max:15'],
            'pendidikan_terakhir' => ['nullable', 'string', 'max:255'],
            'path_foto' => ['nullable', 'image', 'max:1024'], // Max 1MB
            'path_cv' => ['nullable', 'file', 'mimes:pdf', 'max:2048'], // Max 2MB
        ]);

        $profile = $request->user()->profile;

        if ($request->hasFile('path_foto')) {
            // Hapus foto lama jika ada
            if ($profile->path_foto) {
                Storage::disk('public')->delete($profile->path_foto);
            }
            // Simpan foto baru dan dapatkan path-nya
            $validated['path_foto'] = $request->file('path_foto')->store('photos', 'public');
        }

        if ($request->hasFile('path_cv')) {
            // Hapus CV lama jika ada
            if ($profile->path_cv) {
                Storage::disk('public')->delete($profile->path_cv);
            }
            // Simpan CV baru dan dapatkan path-nya
            $validated['path_cv'] = $request->file('path_cv')->store('cvs', 'public');
        }

        $profile->update($validated);

        return Redirect::route('profile.edit')->with('status', 'applicant-profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
