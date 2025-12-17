<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password as PasswordRule;

class PasswordController extends Controller
{
    public function edit(Request $request)
    {
        return view('settings.password-security');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => [
                'required',
                'confirmed',
                PasswordRule::min(8),
            ],
            'logout_other_devices' => ['nullable', 'boolean'],
        ]);

        $user = $request->user();

        $user->forceFill([
            'password' => Hash::make($validated['password']),
        ])->save();

        if ($request->boolean('logout_other_devices')) {
            Auth::logoutOtherDevices($validated['current_password']);
        }

        $request->session()->regenerate();

        return back()->with('password_changed', true);
    }
}
