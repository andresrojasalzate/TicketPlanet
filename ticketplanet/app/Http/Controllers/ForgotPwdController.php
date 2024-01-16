<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use App\Models\User;


class ForgotPwdController extends Controller
{

    public function showResetPwd()
    {
        return view('auth.forgotPwd');
    }

    public function showLinkRequestForm()
    {
        return view('auth.forgotPwd');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Generate a token and send the reset link email
            $token = $this->generateToken();

            $user->update(['reset_token' => $token]);

            // Send the email
            Mail::to($user->email)->send(new ResetPasswordMail($user, $token));

            return back()->with('status', 'Password reset link sent successfully!');
        }

        return back()->withErrors(['email' => 'User not found']);
    }

    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    }

    protected function generateToken()
    {
        // Implement your token generation logic here, for example:
        return bin2hex(random_bytes(32)); // Generates a random 64-character hex string
    }

}
