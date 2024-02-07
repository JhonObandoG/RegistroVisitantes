<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitante;
use Illuminate\Validation\ValidationException;


class AutenticacionController extends Controller
{
    public function mostrarFormularioAutenticacion()
    {
        return view('autenticacion');
    }

    public function procesarAutenticacion(Request $request)
    {
        $documento = $request->input('documento');
        $tipo_documento = $request->input('tipo_documento');
        $nombre = $request->input('nombre');
        $apellido = $request->input('apellido'); 
        $telefono = $request->input('telefono');
        $oficina = $request->input('oficina');
    
        $visitante = Visitante::where('documento', $documento)->first();
    
        if (!$visitante) {
            // Si el visitante no está registrado, crea un nuevo registro con los datos proporcionados
            $visitanteData = [
                'documento' => $documento,
                'tipo_documento' => $tipo_documento,
                'nombre' => $nombre ?? '',
                'apellido' => $apellido ?? '',
                'telefono' => $telefono ?? '',
            ];
    
            if (!is_null($oficina)) {
                $visitanteData['oficina'] = $oficina;
            }
    
            Visitante::create($visitanteData);
        }else {
            // Si el visitante está registrado, verifica si el tipo de documento coincide
            if ($visitante->tipo_documento !== $tipo_documento) {
                // Tipo de documento no coincide, lanza una excepción de validación
                throw ValidationException::withMessages(['tipo_documento' => 'El tipo de documento no coincide con el documento ingresado anteriormente.']);
            }
        }
    
        // Guarda el documento en la sesión
        $request->session()->put('documento', $documento);
    
        // Redirige al formulario de ingreso
        return redirect()->route('mostrar.formulario', ['documento' => $documento]);
    }
    
}
