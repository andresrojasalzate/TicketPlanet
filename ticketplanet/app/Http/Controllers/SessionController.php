<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\User;

class SessionController extends Controller
{
    
    /**
     * Verifica si el usuario está autenticado y muestra las sesiones del promotor.
     * Si el usuario no está autenticado, redirige a la página de inicio de sesión.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function sessionsPromotor(){
        if (Auth::check()) {
            
            $usuario = $this->recuperarSesiones();
        
            Log::info("Mostrado las sesiones del promotor");
            return view('sesiones.sesionesPrometor', ['sessions' => $usuario->sessions]);
        } else{
            return redirect()->route('auth.login');
        }
    }

    /**
     * Recupera las sesiones asociadas al usuario autenticado.
     *
     * @return \App\Models\User|null
     */
    private function recuperarSesiones()
    {
        $user = Auth::user();
        Log::info("Devolvemos el usuario con sus sesiones y evento");
        return User::with('sessions.event')->find($user->id);
    }
}
