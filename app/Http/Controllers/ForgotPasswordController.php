<?php

namespace App\Http\Controllers;

use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
 

    public function forgetPassword()
    {
        return view('Auth.forgotpassword');
    }

    public function forgetPasswordPost(Request $request)
    {
        $request->validate([
            'email' => "required|email|exists:users",
        ]);

        $token = Str::random(64);

        PasswordReset::create([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        Mail::send('Emails.forgetpassword', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject("Reset Password");
        });

        return redirect()->to('login')->with("success", "Password reset link has been sent to your email.");
    }

    public function resetPassword($token)
    {
        return view('Auth.resetpassword', compact('token'));
    }

    public function resetPasswordPost(Request $request)
    {
        $request->validate([
            'email' => "required|email|exists:users",
            'password' => "required|string|confirmed",
            'confirmpassword' => "required"
        ]);

        $updatePassword = PasswordReset::where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$updatePassword) {
            return back()->with("error", "Invalid token.");
        }

        $user = User::where("email", $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        PasswordReset::where('email', $request->email)->delete();

        return redirect()->to("login")->with("success", "Password has been reset successfully.");
    }
}
