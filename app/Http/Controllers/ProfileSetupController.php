<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileSetupController extends Controller
{
    public function show(): View
    {
        return view('auth.profile', [
            'user' => auth()->user(),
        ]);
    }

    public function save(Request $request): RedirectResponse
    {
        $pan = strtoupper(trim((string) $request->input('pan')));

        $request->merge([
            'pan' => $pan === '' ? null : $pan,
        ]);

        $data = $request->validate([
            'pan' => ['nullable', 'regex:/^[A-Z]{5}[0-9]{4}[A-Z]$/'],
            'dob' => ['nullable', 'date', 'before:today'],
        ]);

        $request->user()->update([
            'pan' => $data['pan'] ?: null,
            'dob' => $data['dob'] ?: null,
        ]);

        return redirect()
            ->route('home')
            ->with('status', 'Your details are saved.');
    }

    public function skip(): RedirectResponse
    {
        return redirect()
            ->route('home')
            ->with('status', 'You can add PAN and date of birth later.');
    }
}
