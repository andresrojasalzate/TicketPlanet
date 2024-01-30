<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Mail\ValidacionMail;
use App\Models\Valoracion;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ValoracionController extends Controller
{
    public function mostrarFormulario()
    {
        $eventoId = 1;
        return view('valoracion.formValoracion', ['eventoId' => $eventoId]);
    }

    public function enviarCorreoValoracion(Request $request)
    {
        $usuarioAutenticado = auth()->user();

        // Verifica si el usuario está autenticado
        if ($usuarioAutenticado) {
            $correoDestino = $usuarioAutenticado->email;

            try {
                $eventoId = $request->evento;
                $evento = Event::findOrFail($eventoId);
                // Envía el correo al usuario autenticado
                Mail::to($correoDestino)->send(new ValidacionMail($usuarioAutenticado, $evento));
                Log::info('Correo de valoración enviado a: ' . $correoDestino);
                return back()->with('status', '¡Correo de valoración enviado con éxito!');
            } catch (\Exception $e) {
                Log::error('Error al enviar correo de valoración: ' . $e->getMessage());
                return back()->withErrors(['error' => 'Error al enviar correo de valoración. Por favor, inténtelo de nuevo más tarde.']);
            }
        } else {
            Log::warning('Se intentó enviar el correo de valoración pero no hay usuario autenticado.');
            return back()->withErrors(['error' => 'No hay usuario autenticado.']);
        }

    }

    public function guardarValoracion(Request $request)
    {
        
        // Valida los datos del formulario
        $request->validate([
            'nombre' => 'required|string',
            'caraSeleccionada' => 'required|string',
            'puntuacionSeleccionada' => 'required|integer',
            'titulo_comentario' => 'nullable|string',
            'comentario' => 'nullable|string',
        ]);
        
        try {
            // Crea un nuevo objeto Valoracion con los datos del formulario
            $valoracion = new Valoracion();
            $valoracion->nombre = $request->nombre;
            $valoracion->caraSeleccionada = $request->caraSeleccionada;
            $valoracion->puntuacionSeleccionada = $request->puntuacionSeleccionada;
            $valoracion->titulo_comentario = $request->input('titulo_comentario');
            $valoracion->comentario = $request->input('comentario');
            $valoracion->save();
    
            // Registro de éxito en el log
            Log::info('Valoración guardada en la base de datos: ' . $valoracion);
    
            // Redirige de vuelta con un mensaje de éxito
            return back()->with('status', '¡Valoración enviada con éxito!');
        } catch (\Exception $e) {
            // Registro de error en el log
            Log::error('Error al guardar la valoración: ' . $e->getMessage());
    
            // Redirige de vuelta con un mensaje de error
            return back()->withErrors(['error' => 'Error al guardar la valoración. Por favor, inténtelo de nuevo más tarde.']);
        }
    }
}
