<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Compra;
use App\Models\Session;
use App\Mail\ValidacionMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EnviarCorreosValoracion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:enviar-correos-valoracion';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enviar correo un día después del evento';

    /**
     * Execute the console command.
     */
    // public function handle()
    // {
    //     // Obtener la fecha de hoy y la fecha de mañana
    //     $hoy = Carbon::now()->toDateString();
    //     $diaSiguiente = Carbon::tomorrow()->toDateString();

    //     // Obtener las sesiones que ocurrieron ayer
    //     $sesiones = Session::whereDate('date', $hoy)->get();

    //     foreach ($sesiones as $sesion) {
    //         // Obtener las compras asociadas a esta sesión
    //         $compras = Compra::where('session_id', $sesion->id)->get();

    //         foreach ($compras as $compra) {
    //             // Envía el correo de recordatorio un día después del evento a los usuarios que han realizado compras para esta sesión
    //             $usuario = $compra->usuario; // Asumiendo que tienes una relación definida para obtener el usuario asociado a la compra
    //             Mail::to($compra->emailPurchaser)->send(new ValidacionMail($usuario, $sesion));
    //         }
    //     }

    //     // Registrar actividad
    //     Log::info('Comando de enviar correos de valoración ejecutado correctamente.');
    // }

    public function handle()
    {
        // Obtener la fecha de hoy
        $hoy = Carbon::now()->toDateString();

        // Obtener la fecha de hace un día
        $ayer = Carbon::yesterday()->toDateString();

        // Obtener las sesiones que ocurrieron hace un día
        $sesiones = Session::whereDate('date', $ayer)->get();

        foreach ($sesiones as $sesion) {
            // Obtener las compras asociadas a esta sesión
            $compras = Compra::where('session_id', $sesion->id)->get();

            foreach ($compras as $compra) {
                if ($compra->usuario) {
                    // Envía el correo de valoración a los usuarios que han realizado compras para la sesión de ayer
                    Mail::to($compra->emailPurchaser)->send(new ValidacionMail($compra->usuario, $sesion));
                } else {
                    Log::warning('Se encontró una compra sin usuario asociado.');
                }
            }
        }

        // Registrar actividad
        Log::info('Comando de enviar correos de valoración ejecutado correctamente.');
    }
}
