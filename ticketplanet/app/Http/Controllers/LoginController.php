<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'Por favor, introduce una dirección de correo electrónico válida.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.string' => 'Por favor, introduce una contraseña válida.',
        ]);
        
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) { 
            $request->session()->regenerate(); 

            return redirect()->intended(route('links.homePromotors')); 
        }

        return redirect(route('auth.login'))->with('status', ['message' => '¡Las credenciales no son correctas!','class' => 'mensaje-error']);
    }

    public function logout()
    {
        session()->flush(); 
        Auth::logout(); 

        return redirect('login');
    }
}
