<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\EmailVerification;
use App\Mail\VerificationCodeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RegisterRequest;

class AdminRegistrationController extends Controller
{
    public function create()
    {
        return view('auth.register-admin');

    }

    public function store(RegisterRequest $request)
    {
          $data = $request->validated();

        $user = User::create([

            'name' => $request->first_name . ' ' . $request->last_name,
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
        ]);

        $user->assignRole('admin');


        $code = random_int(100000, 999999);
        EmailVerification::create([
            'user_id' => $user->id,
            'code' => $code,
            'expires_at' => now()->addMinutes(60),
        ]);

       dispatch(new \App\Jobs\SendVerificationCodeJob($code, $user));


       return redirect()->route('verify.code', ['email' => $user->email]);
    }
}
