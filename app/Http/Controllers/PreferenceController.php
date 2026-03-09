<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PreferenceController extends Controller
{
    public function notifications(Request $request): View
    {
        $user = $request->user();

        return view('profile.notifications', compact('user'));
    }

    public function updateNotifications(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email_notifications' => ['boolean'],
        ]);

        $request->user()->preferences()->updateOrCreate(
            [],
            $validated
        );

        return back()->with('status', 'notifications-updated');
    }

    public function appearance(Request $request): View
    {
        $user = $request->user();

        return view('profile.appearance', compact('user'));
    }

    public function updateAppearance(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'theme' => ['required', 'string'],
        ]);

        $request->user()->preferences()->updateOrCreate(
            [],
            $validated
        );

        return back()->with('status', 'appearance-updated');
    }
}