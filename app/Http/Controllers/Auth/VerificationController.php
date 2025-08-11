<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCodeMail;

class VerificationController extends Controller
{
    public function showVerifyForm()
    {
        $email = session('verify_email') ?? request('email');
        return view('auth.verify_code', compact('email'));
    }

    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'code'  => 'required|digits:6',
        ]);

        $user = User::where('email', $request->email)
            ->where('verification_code', $request->code)
            ->first();

        if (!$user) {
            return back()->withErrors(['code' => 'Invalid code or email.']);
        }

        $user->email_verified_at = now();
        $user->verification_code = null;
        $user->save();

        auth()->login($user);

        return redirect('/')->with('success', 'Email verified successfully.');
    }

    public function resend(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $user = User::where('email', $request->email)->first();

        $code = mt_rand(100000, 999999);
        $user->verification_code = $code;
        $user->save();

        Mail::to($user->email)->send(new VerificationCodeMail($code, $user->first_name));

        return back()->with('status', 'Verification code resent.');
    }
}
