<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\User;

class SessionController extends Controller
{
    public function sessionsPromotor(){
        if (Auth::check()) {
            
            $usuario = $this->recuperarSesiones();
            Log::info("Mostrado las sesiones del promotor");
            return view('sesiones.sesionesPrometor', ['sessions' => $usuario->sessions]);
        } else{
            return redirect()->route('auth.login');
        }
    }

    private function recuperarSesiones()
    {
        $user = Auth::user();

        return User::with('sessions.event')->find($user->id);
    }
}
