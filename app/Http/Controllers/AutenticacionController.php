<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitante;

class AutenticacionController extends Controller
{
    public function mostrarFormularioAutenticacion()
    {
        return view('autenticacion');
    }

    public function procesarAutenticacion(Request $request)
    {
        $documento = $request->input('documento');
        $nombre = $request->input('nombre');
        $apellido = $request->input('apellido'); 
        $telefono = $request->input('telefono');
        $oficina = $request->input('oficina');
    
        $visitante = Visitante::where('documento', $documento)->first();
    
        if (!$visitante) {
            // Si el visitante no está registrado, crea un nuevo registro con los datos proporcionados
            $visitanteData = [
                'documento' => $documento,
                'nombre' => $nombre ?? '',
                'apellido' => $apellido ?? '',
                'telefono' => $telefono ?? '',
            ];
    
            if (!is_null($oficina)) {
                $visitanteData['oficina'] = $oficina;
            }
    
            Visitante::create($visitanteData);
        }
    
        // Guarda el documento en la sesión
        $request->session()->put('documento', $documento);
    
        // Redirige al formulario de ingreso
        return redirect()->route('mostrar.formulario', ['documento' => $documento]);
    }
    
}
