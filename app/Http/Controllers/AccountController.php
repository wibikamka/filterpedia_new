<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse; 
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
class AccountController extends Controller
{
    // Method index yang sudah ada
    public function index(Request $request): View
    {
        return view('profile.account', ['user' => $request->user()]);
    }
    
    // TAMBAHKAN METHOD-METHOD INI
    public function updateName(Request $request): JsonResponse
    {
        $request->validate(['name' => 'required|string|max:255']);
        $request->user()->update(['name' => $request->name]);
        
        return response()->json([
            'success' => true,
            'message' => 'Nama berhasil diperbarui'
        ]);
    }
    
    public function updateUsername(Request $request): JsonResponse
    {
        $request->validate([
            'username' => 'nullable|string|max:255|unique:users,username,' . auth()->id()
        ]);
        $request->user()->update(['username' => $request->username]);
        
        return response()->json([
            'success' => true,
            'message' => 'Username berhasil diperbarui'
        ]);
    }
    
    public function updateBio(Request $request): JsonResponse
    {
        $request->validate(['bio' => 'nullable|string|max:500']);
        $request->user()->update(['bio' => $request->bio]);
        
        return response()->json([
            'success' => true,
            'message' => 'Bio berhasil diperbarui'
        ]);
    }
    
    public function updateEmail(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id()
        ]);
        $request->user()->update([
            'email' => $request->email,
            'email_verified_at' => null
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Email berhasil diperbarui. Silakan verifikasi email baru Anda.'
        ]);
    }
    
    public function updatePhone(Request $request): JsonResponse
    {
        $request->validate(['phone' => 'nullable|string|max:20']);
        $request->user()->update(['phone' => $request->phone]);
        
        return response()->json([
            'success' => true,
            'message' => 'Nomor telepon berhasil diperbarui'
        ]);
    }
    public function updateAvatar(Request $request): JsonResponse
{
    try {
        $request->validate([
            'avatar' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);
        
        $user = $request->user();
        
        // Hapus avatar lama jika ada
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }
        
        // Simpan avatar baru
        $path = $request->file('avatar')->store('avatars', 'public');
        $user->update(['avatar' => $path]);
        
        return response()->json([
            'success' => true,
            'message' => 'Foto profil berhasil diperbarui',
            'data' => [
                'avatar_url' => asset('storage/' . $path)
            ]
        ]);
        
    } catch (ValidationException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Validasi gagal',
            'errors' => $e->errors()
        ], 422);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Gagal upload: ' . $e->getMessage()
        ], 500);
    }
}
}       