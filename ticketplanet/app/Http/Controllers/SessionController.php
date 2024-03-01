<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Compra;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{

    /**
     * Verifica si el usuario está autenticado y muestra las sesiones del promotor.
     * Si el usuario no está autenticado, redirige a la página de inicio de sesión.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function sessionsPromotor()
    {
        if (Auth::check()) {

            $usuario = $this->recuperarSesiones();

            Log::info("Mostrado las sesiones del promotor");
            return view('sesiones.sesionesPrometor', ['sessions' => $usuario->sessions()->orderBy('date', 'desc')->get()]);
        } else {
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

    public function cambiarEstadoSesion(Request $request)
    {

        $idSesion = $request->idSesion;

        $sesion = Session::find($idSesion);

        $estadoSesion = $sesion->open;

        $sesion->open = !$estadoSesion;

        $sesion->save();

        return back();
    }

    public function exportarCSV($sessionId)
    {
        $session = Session::findOrFail($sessionId);
        $compras = Compra::whereHas('session', function ($query) use ($sessionId) {
            $query->where('id', $sessionId);
        })->with('assistants.ticket')->get();

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=entradas_sessio_" . $sessionId . ".csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $generatedNumbers = []; // Array para almacenar números generados

        $callback = function () use ($compras, &$generatedNumbers) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Nom comprador', 'Nom Assistent', 'Codi d’entrada', 'Tipus d’entrada']);

            foreach ($compras as $compra) {
                foreach ($compra->assistants as $assistant) {
                    // Generar un número aleatorio único de 8 dígitos
                    $randomNumber = $this->generateUniqueRandomNumber($generatedNumbers);
                    $generatedNumbers[] = $randomNumber;

                    fputcsv($file, [$compra->namePurchaser, $assistant->nameAssistant, $randomNumber, $assistant->ticket->name]);
                }
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function generateUniqueRandomNumber($existingNumbers)
    {
        do {
            $randomNumber = mt_rand(10000000, 99999999);
        } while (in_array($randomNumber, $existingNumbers));

        return $randomNumber;
    }
}
