<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitante;
use App\Models\Historial;

class IngresoController extends Controller
{
    public function mostrarFormulario(Request $request, $documento)
    {
        $visitante = Visitante::where('documento', $documento)->first();
    
        if (!$visitante) {
            return redirect()->route('mostrar.formulario.autenticacion')->with('no_autenticado', true);
        }
    
        $historial = Historial::where('documento', $documento)->latest()->first();
    
        if ($historial && $historial->hora_salida !== null) {
            // Si existe historial y ya se registró la salida, redirige a la página de formulario de ingreso
            $primeraVez = $request->session()->has('documento') && $request->session()->get('documento') === $documento;
            
            return view('ingreso', compact('visitante', 'historial', 'primeraVez'));
        }
    
        elseif ($historial && $historial->hora_salida === null) {
            // Si existe historial y no se ha registrado la salida, redirige a la confirmación de salida
            return redirect()->route('vista.confirmacion.salida', ['documento' => $documento]);
        };

        $primeraVez = $request->session()->has('documento') && $request->session()->get('documento') === $documento;
    
        return view('ingreso', compact('visitante', 'historial', 'primeraVez'));
    }
    public function procesarFormulario(Request $request)
    {
        $documento = $request->input('documento');

        $historial = Historial::where('documento', $documento)->latest()->first();

        $nombre = $request->input('nombre');
        $apellido = $request->input('apellido');
        $fecha_ingreso = today();
        $hora_ingreso = now();
        $oficina = $request->input('oficina');

        // Convierte el valor de 'oficina' en una cadena
        $oficinaString = strval($oficina);

        // Crear o actualizar el visitante
        $visitante = Visitante::firstOrNew(['documento' => $documento]);
        $visitante->fill([
            'nombre' => $nombre,
            'apellido' => $apellido,
            'telefono' => $request->input('telefono'),
            'oficina' => $oficinaString,
        ]);

        $visitante->save();
    
        // Crear un nuevo historial
        $historial = new Historial();

        $historial->nombre = $request->nombre;
        $historial->apellido = $request->apellido;
        $historial->documento = $request->documento;
        $historial->telefono = $request->telefono;
        $historial->oficina = $request->oficina;
        $historial->fecha_ingreso = $fecha_ingreso;
        $historial->hora_ingreso = $request->hora;
        $historial->a_quien_visita = $request->a_quien_visita;
        $historial->motivo = $request->motivo;

        $historial->save();

        $request->session()->put('documento', $documento);
    
        // Determinar si se debe mostrar el botón y definir los mensajes
        $mostrarBotonSalida = true; // Mostrar el botón después de finalizar el ingreso
        $mensajeAgradecimiento = '¡Gracias por registrar su ingreso!';
        $mensajeAdicional = 'No olvide registrar su salida al finalizar sus actividades.';
    
        // Verificar si la solicitud proviene de una vista de agradecimiento anterior y redirige en consecuencia
        if ($request->session()->has('vista_agradecimiento')) {
            return redirect()->route('vista.agradecimiento', ['documento' => $documento]);
        }
    
        return view('agradecimiento', compact('mensajeAgradecimiento', 'mensajeAdicional', 'mostrarBotonSalida', 'documento'));
    }
    
    

    public function vistaAgradecimiento()
    {
        return view('agradecimiento');
    }

    public function mostrarHistorial(Request $request)
    {
        // Obtén las fechas desde el formulario
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');
    
        // Filtra los registros por fechas
        $query = Historial::query();
    
        if ($fechaInicio && $fechaFin) {
            $query->where(function ($query) use ($fechaInicio, $fechaFin) {
                $query->whereBetween('fecha_ingreso', [$fechaInicio, $fechaFin])
                    ->orWhereBetween('fecha_ingreso', [$fechaFin, $fechaInicio]);
            });
        }
    
        // Ordena los resultados por fecha_ingreso y hora_ingreso de forma descendente
        $query->orderByDesc('fecha_ingreso')->orderByDesc('hora_ingreso');
    
        // Obtén el historial paginado con 10 resultados por página
        $historial = $query->paginate(10);
    
        return view('historial', ['historial' => $historial, 'request' => $request]);
    }
    
    
    
    
    


    public function confirmacionSalida($documento)
    {
        $historial = Historial::where('documento', $documento)->latest()->first();

        return view('confirmacion_salida', ['historial' => $historial]);
    }

    public function procesarSalida($documento)
    {
        // Buscar el historial más reciente
        $historial = Historial::where('documento', $documento)->latest()->first();

        if ($historial) {
            // Verificar si ya se registró la salida
            if ($historial->hora_salida !== null) {
                // Si ya hay una hora de salida, redirige a la página de agradecimiento
                return redirect()->route('vista.agradecimiento', ['documento' => $documento]);
            }

            // Actualizar la hora de salida
            $historial->update([
                'hora_salida' => now(),
            ]);

            // Mostrar mensajes para la confirmación de salida
            $mostrarBotonSalida = false; 
            $mensajeAgradecimiento = '¡Gracias por su visita!';
            $mensajeAdicional = 'Esperamos que haya tenido una visita exitosa.';

            // Redirige al agradecimiento con la información necesaria
            return view('agradecimiento', compact('mensajeAgradecimiento', 'mensajeAdicional', 'mostrarBotonSalida', 'documento'));
        }

    }
}