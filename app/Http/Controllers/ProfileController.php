<?php
// app/Http/Controllers/ProfileController.php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form (Tokopedia style).
     */
    public function index(Request $request): View
    {
        return view('profile.index', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Show edit name form.
     */
    public function editName(Request $request): View
    {
        return view('profile.edit-name', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update user's name.
     */
    public function updateName(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $request->user()->update([
            'name' => $request->name
        ]);

        return Redirect::route('profile.index')->with('success', 'Nama berhasil diperbarui');
    }

    /**
     * Show edit username form.
     */
    public function editUsername(Request $request): View
    {
        return view('profile.edit-username', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update user's username.
     */
    public function updateUsername(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['nullable', 'string', 'max:255', 'unique:users,username,' . auth()->id()],
        ]);

        $request->user()->update([
            'username' => $request->username
        ]);

        return Redirect::route('profile.index')->with('success', 'Username berhasil diperbarui');
    }

    /**
     * Show edit bio form.
     */
    public function editBio(Request $request): View
    {
        return view('profile.edit-bio', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update user's bio.
     */
    public function updateBio(Request $request): RedirectResponse
    {
        $request->validate([
            'bio' => ['nullable', 'string', 'max:500'],
        ]);

        $request->user()->update([
            'bio' => $request->bio
        ]);

        return Redirect::route('profile.index')->with('success', 'Bio berhasil diperbarui');
    }

    /**
     * Show edit email form.
     */
    public function editEmail(Request $request): View
    {
        return view('profile.edit-email', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update user's email.
     */
    public function updateEmail(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . auth()->id()],
        ]);

        $request->user()->update([
            'email' => $request->email,
            'email_verified_at' => null // Force re-verification
        ]);

        return Redirect::route('profile.index')->with('success', 'Email berhasil diperbarui. Silakan verifikasi email baru Anda.');
    }

    /**
     * Show edit phone form.
     */
    public function editPhone(Request $request): View
    {
        return view('profile.edit-phone', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update user's phone.
     */
    public function updatePhone(Request $request): RedirectResponse
    {
        $request->validate([
            'phone' => ['nullable', 'string', 'max:20'],
        ]);

        $request->user()->update([
            'phone' => $request->phone
        ]);

        return Redirect::route('profile.index')->with('success', 'Nomor handphone berhasil diperbarui');
    }

    /**
     * Show edit avatar form.
     */
    public function editAvatar(Request $request): View
    {
        return view('profile.edit-avatar', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update user's avatar.
     */
    public function updateAvatar(Request $request): RedirectResponse
    {
        $request->validate([
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada
            if ($request->user()->avatar) {
                Storage::disk('public')->delete($request->user()->avatar);
            }

            // Simpan avatar baru
            $path = $request->file('avatar')->store('avatars', 'public');
            
            $request->user()->update([
                'avatar' => $path
            ]);
        }

        return Redirect::route('profile.index')->with('success', 'Foto profil berhasil diperbarui');
    }

    /**
     * =====================================================
     * METHODS ORIGINAL (DARI BAWAAN LARAVEL BREEZE/JETSTREAM)
     * =====================================================
     */

    /**
     * Display the user's profile form. (Original)
     */


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

    /**
     * Optional: Keep your existing show method if needed
     */
    public function show(Request $request)
    {
        return view('profile.account', [
            'user' => $request->user(),
        ]);
    }
}