<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SessionController extends Controller
{
    public function sessionsPromotor(){

        Log::info("Mostrado las sesiones del promotor");
        return view('sesiones.sesionesPrometor');
    }
}
