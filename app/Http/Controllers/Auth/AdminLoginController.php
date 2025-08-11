<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $user = Auth::user();

            // 1. Block customers from logging in
            if (!$user->hasRole('admin')) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'You are not allowed to login from here',
                ]);
            }

            // 2. Block unverified admins
            if (!$user->email_verified_at) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Please verify your account before logging in.',
                ]);
            }

            // ✅ Success: Redirect to admin dashboard
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials provided.',
        ]);
    }
}
