<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\EmailVerification;
use App\Models\User;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function showForm(Request $request)
    {
          $email = $request->query('email');
         return view('auth.verify-code', compact('email'));
    }

    public function verify(Request $request)
    {
        
    
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'code'  => 'required|string',
        ]);

        
        $user = User::where('email', $request->email)->first();
        $ev = EmailVerification::where('user_id', $user->id)
            ->where('code', $request->code)
            ->latest()->first();

        if (! $ev || $ev->expired()) {
            return back()->withErrors(['code' => 'Invalid or expired code.']);
        }

        $user->forceFill(['email_verified_at' => now()])->save();
        EmailVerification::where('user_id', $user->id)->delete();

        return redirect()->route('login')->with('status', 'Email verified! You may now login.');
    }
}
