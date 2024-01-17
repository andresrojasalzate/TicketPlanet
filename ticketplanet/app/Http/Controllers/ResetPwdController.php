<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ResetPwdController extends Controller
{
    /**
     * Display the password reset view.
     *
     * @param  string  $token
     * @return \Illuminate\View\View
     */
    public function showResetForm($token)
    {

        // Verifica si el token ha expirado
        $tokenData = DB::table('password_reset_tokens')->where('token', $token)->first();

        if (!$tokenData || $this->tokenExpired($tokenData->created_at)) {
            return view('auth.expired'); // Nombre de la vista para el enlace expirado
        }


        Log::info('Token recibido: ' . $token);

        return view('auth.resetPwd')->with(['token' => $token]);
    }

    /**
     * Handle a reset password request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
            ],
        ], [
            'token.required' => 'El token es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección de correo válida.',
            'email.exists' => 'No hemos podido encontrar un usuario con ese correo electrónico.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.regex' => 'La contraseña debe contener al menos una minúscula, una mayúscula, un dígito y un carácter especial entre @$!%*?&.',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                    'remember_token' => Str::random(60),
                ])->save();

                Auth::guard()->login($user);
            }
        );

        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('home')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);

    }

    protected function tokenExpired($createdAt)
    {
        $expirationTime = config('auth.passwords.users.expire') * 60;
        $isExpired = strtotime($createdAt) + $expirationTime < now()->timestamp;

        Log::info('¿Token expirado? ' . ($isExpired ? 'Sí' : 'No'));
    
        return $isExpired;
    }
}
