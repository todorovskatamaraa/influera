<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (! Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Incorrect credentials.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role !== 'admin' && $user->status !== 'approved') {

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            $message = 'Your account is not approved yet. Please wait for admin approval.';

            if ($user->status === 'rejected') {
                $message = 'Your account has been rejected. Please contact support if you think this is a mistake.';
            }

            return back()
                ->withErrors(['email' => $message])
                ->onlyInput('email');
        }

        session()->flash('welcome_back', 'Welcome back, ' . $user->name . '!');

        return match ($user->role) {
            'influencer' => redirect()->route('influencer-dashboard'),
            'brand'      => redirect()->route('business-dashboard'),
            'admin'      => redirect()->route('admin.dashboard'),
            default      => redirect('/'),
        };
    }
}
