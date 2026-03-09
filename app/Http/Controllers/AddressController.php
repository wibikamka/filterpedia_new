<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AddressController extends Controller
{
    public function index(Request $request): View
    {
        $addresses = $request->user()->addresses;

        return view('profile.addresses', compact('addresses'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'label' => ['required', 'string'],
            'address' => ['required', 'string'],
        ]);

        $request->user()->addresses()->create($validated);

        return back()->with('status', 'address-added');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $address = $request->user()->addresses()->findOrFail($id);

        $validated = $request->validate([
            'label' => ['required', 'string'],
            'address' => ['required', 'string'],
        ]);

        $address->update($validated);

        return back()->with('status', 'address-updated');
    }

    public function destroy(Request $request, $id): RedirectResponse
    {
        $address = $request->user()->addresses()->findOrFail($id);

        $address->delete();

        return back()->with('status', 'address-deleted');
    }
}