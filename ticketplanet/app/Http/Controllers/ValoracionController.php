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
    public function mostrarFormulario($eventoId)
    {
        return view('valoracion.formValoracion', ['eventoId' => $eventoId]);
    }

    public function enviarCorreoValoracion(Request $request)
    {
        $usuarioAutenticado = auth()->user();

        // Verifica si el usuario está autenticado
        if ($usuarioAutenticado) {
            $correoDestino = $usuarioAutenticado->email;

            try {
                $eventoId = $request->input('evento');
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
            return redirect()->route('auth.login')->withErrors(['error' => 'Debes iniciar sesión para enviar un correo de valoración.']);
        }

    }

    public function guardarValoracion(Request $request)
    {
        
        // Valida los datos del formulario
        $request->validate([
            'nombre' => 'required|string',
            'caraSeleccionada' => 'required|string',
            'puntuacionSeleccionada' => 'required|integer',
            'tituloComentario' => 'required|string',
            'comentario' => 'required|string',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.string' => 'Por favor, introduce un nombre válido.',
            'caraSeleccionada.required' => 'El campo cara seleccionada es obligatorio.',
            'caraSeleccionada.string' => 'Por favor, selecciona una cara válida.',
            'puntuacionSeleccionada.required' => 'El campo puntuación seleccionada es obligatorio.',
            'puntuacionSeleccionada.integer' => 'La puntuación debe ser un número entero.',
            'tituloComentario.required' => 'El campo título del comentario es obligatorio.',
            'tituloComentario.string' => 'Por favor, introduce un título de comentario válido.',
            'comentario.required' => 'El campo comentario es obligatorio.',
            'comentario.string' => 'Por favor, introduce un comentario válido.',
        ]);
        
        try {
            // Crea un nuevo objeto Valoracion con los datos del formulario
            $valoracion = new Valoracion();
            $valoracion->nombre = $request->nombre;
            $valoracion->caraSeleccionada = $request->caraSeleccionada;
            $valoracion->puntuacionSeleccionada = $request->puntuacionSeleccionada;
            $valoracion->tituloComentario = $request->input('tituloComentario');
            $valoracion->comentario = $request->input('comentario');
            $valoracion->event_id = $request->input('evento_id');
            $valoracion->save();
    
            // Registro de éxito en el log
            Log::info('Valoración guardada en la base de datos: ' . $valoracion);
    
            // Redirige de vuelta con un mensaje de éxito
            return back()->with('valoracionGuardada', true);
        } catch (\Exception $e) {
            // Registro de error en el log
            Log::error('Error al guardar la valoración: ' . $e->getMessage());
    
            // Redirige de vuelta con un mensaje de error
            return back()->withErrors(['error' => 'Error al guardar la valoración. Por favor, inténtelo de nuevo más tarde.']);
        }
    }
}
