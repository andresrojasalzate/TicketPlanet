<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Models\User;
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
        $tokenData = DB::table('users')->where('reset_token', $token)->first();

        if (!$tokenData || $this->tokenExpired($tokenData->reset_token_created_at)) {
            return view('auth.expired'); // Nombre de la vista para el enlace expirado
        }

        $email = $tokenData->email;

        Log::info('Token recibido: ' . $token);

        return view('auth.resetPwd')->with(['email' => $email, 'token' => $token]);
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


        $contra = $request->input('password');
        $usuario = $request->input('email');
        $token = $request->input('token');

        $user = User::UserEmail($usuario);

        // Verifica si el token ha expirado por tiempo
        if ($this->tokenExpired($user->reset_token_created_at)) {
            // Si ha pasado 1 hora o más, establece reset_token_created_at a null
            $user->reset_token_created_at = null;
            $user->save();

            return redirect()->route('auth.expired');
        }

        // Actualiza la contraseña y restablece el token
        $user->fill([
            'password' => bcrypt($contra),
            'remember_token' => $user->reset_token,
            'reset_token' => null,
            'reset_token_created_at' => null,
        ])->save();

        return redirect()->route('auth.login')->with('status', [
            'message' => 'Contraseña restablecida exitosamente. Inicia sesión con tu nueva contraseña.',
            'class' => 'correcto'
        ]);

    }

    public function tokenExpired($tokenCreatedAt)
    {
        $expirationTime = config('auth.passwords.users.expire') * 60;
        $isExpired = strtotime($tokenCreatedAt) + $expirationTime < now()->timestamp;

        Log::info('¿Token expirado? ' . ($isExpired ? 'Sí' : 'No'));
        Log::info($expirationTime);

        return $isExpired;
    }
}
