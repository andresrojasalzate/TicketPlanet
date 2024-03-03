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
    
    public function handle()
    {
        // Obtener la fecha de hoy y la fecha de mañana
        $hoy = Carbon::now()->toDateString();
        $diaSiguiente = Carbon::tomorrow()->toDateString();

        // Registro de log para verificar las fechas obtenidas
        Log::info('Fecha de hoy: ' . $hoy);
        Log::info('Fecha de mañana: ' . $diaSiguiente);

        // Obtener las sesiones que ocurrieron hoy
        $sesiones = Session::whereDate('date', $hoy)->get();

        // Registro de log para verificar las sesiones obtenidas
        Log::info('Número de sesiones encontradas para hoy: ' . $sesiones->count());

        foreach ($sesiones as $sesion) {
            // Obtener las compras asociadas a esta sesión
            $compras = Compra::where('session_id', $sesion->id)->get();

            // Registro de log para verificar las compras obtenidas
            Log::info('Número de compras encontradas para la sesión ' . $sesion->id . ': ' . $compras->count());

            foreach ($compras as $compra) {
                // Envía el correo de recordatorio un día después del evento a los usuarios que han realizado compras para esta sesión
                $usuario = $compra->usuario; // Asumiendo que tienes una relación definida para obtener el usuario asociado a la compra
                Mail::to($compra->emailPurchaser)->send(new ValidacionMail($usuario, $sesion));

                // Registro de log para verificar el envío de correos
                Log::info('Correo de valoración enviado a ' . $compra->emailPurchaser . ' para la sesión ' . $sesion->id);
            }
        }

        // Registrar actividad
        Log::info('Comando de enviar correos de valoración ejecutado correctamente.');
    }
}
