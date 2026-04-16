<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class AddressController extends Controller
{
    // Store via web form (redirect)
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'label' => ['nullable', 'string', 'max:50'],
            'recipient_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'full_address' => ['required', 'string'],
            'city' => ['required', 'string', 'max:100'],
            'province' => ['required', 'string', 'max:100'],
            'postal_code' => ['required', 'string', 'max:10'],
            'is_default' => ['boolean'],
        ]);
        
        $validated['user_id'] = auth()->id();
        
        // HANYA 1 ALAMAT DEFAULT
        if ($validated['is_default'] ?? false) {
            // Jika user memilih default, unset semua default lain
            auth()->user()->addresses()->update(['is_default' => false]);
        } elseif (auth()->user()->addresses()->count() === 0) {
            // Jika ini alamat pertama, otomatis jadi default
            $validated['is_default'] = true;
        }
        
        Address::create($validated);
        
        return redirect()->back()->with('success', 'Alamat berhasil ditambahkan');
    }
    
    // Update via AJAX (untuk inline edit)
    public function update(Request $request, Address $address): JsonResponse
    {
        if ($address->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        
        $validated = $request->validate([
            'label' => ['nullable', 'string', 'max:50'],
            'recipient_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'full_address' => ['required', 'string'],
            'city' => ['required', 'string', 'max:100'],
            'province' => ['required', 'string', 'max:100'],
            'postal_code' => ['required', 'string', 'max:10'],
            'is_default' => ['boolean'],
        ]);
        
        // LOGIC: HANYA 1 ALAMAT DEFAULT
        if ($validated['is_default'] ?? false) {
            // Jika address ini dijadikan default, unset default yang lain
            auth()->user()->addresses()
                ->where('id', '!=', $address->id)
                ->update(['is_default' => false]);
        } elseif ($address->is_default && !($validated['is_default'] ?? false)) {
            // Jika address sebelumnya default dan user uncheck, cari address lain untuk jadi default
            $newDefault = auth()->user()->addresses()
                ->where('id', '!=', $address->id)
                ->first();
            if ($newDefault) {
                $newDefault->update(['is_default' => true]);
            }
        }
        
        $address->update($validated);
        
        return response()->json([
            'success' => true,
            'message' => 'Alamat berhasil diperbarui'
        ]);
    }
    
    // Delete
    public function destroy(Address $address): RedirectResponse
    {
        if ($address->user_id !== auth()->id()) {
            abort(403);
        }
        
        $wasDefault = $address->is_default;
        $address->delete();
        
        // Jika yang dihapus adalah alamat default, set alamat lain jadi default
        if ($wasDefault) {
            $newDefault = auth()->user()->addresses()->first();
            if ($newDefault) {
                $newDefault->update(['is_default' => true]);
            }
        }
        
        return redirect()->back()->with('success', 'Alamat berhasil dihapus');
    }
}