<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ForgotPwdController extends Controller
{

    public function showResetPwd()
    {
        return view('auth.forgotPwd');
    }

    //no usada?
    public function showLinkRequestForm()
    {
        return view('auth.forgotPwd');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Genera un token y actualiza la base de datos
            $token = $this->generateToken();

            $user->update(['reset_token' => $token]);

            // Envía el correo
            Mail::to($user->email)->send(new ResetPasswordMail($user, $token));

            Log::info('Correo de restablecimiento enviado a: ' . $user->email);

            return back()->with('status', '¡Enlace de restablecimiento de contraseña enviado con éxito!');
        }

        return back()->withErrors(['email' => 'Usuario no encontrado']);
    }

    protected function validateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'El campo de correo electrónico es obligatorio.',
            'email.email' => 'Por favor, introduce una dirección de correo electrónico válida.',
        ]);
    }

    protected function generateToken()
    {
        // Implementa la lógica de generación de token
        return Str::random(64); 
    }

}
