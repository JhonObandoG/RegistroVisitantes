<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Visitas</title>
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 20px 0;
            padding: 0;
            overflow-y: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            min-height: 100vh;
        }

        h1 {
            color: #056ffa;
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.5rem;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            border-bottom: 2px solid #007bff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .user-info-details span {
            font-size: 0.8em;
        }

        .visit-title {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            border-bottom: 2px solid #ffffff;
            font-size: 1.2rem;
        }

        .user-info-details span {
            display: block;
            margin-bottom: 5px;
        }

        .motivo {
            font-weight: bold;
        }

        .hora-salida {
            font-weight: bold;
            color: #e53e3e; 
        }
    </style>
</head>

<body>
    <h1>Historial de Visitas</h1>
    <div class="mt-4">
        <a href="{{ route('mostrar.historial') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Quitar Filtro</a>
    </div>

    <form action="{{ route('mostrar.historial') }}" method="get">
        @csrf
        <label for="fecha_inicio">Fecha de Inicio:</label>
        <input type="date" name="fecha_inicio" required>
    
        <label for="fecha_fin">Fecha de Fin:</label>
        <input type="date" name="fecha_fin" required>
    
        <button type="submit">Filtrar</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Documento</th>
                <th>Fecha de Ingreso</th>
                <th>Hora de Ingreso</th>
                <th>Hora de Salida</th>
                <th>Motivo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($historial as $ingreso)
                <tr>
                    <td>{{ $ingreso->nombre }} {{ $ingreso->apellido }}</td>
                    <td>{{ $ingreso->documento }}</td>
                    <td>{{ $ingreso->fecha_ingreso }}</td>
                    <td>{{ $ingreso->hora_ingreso }}</td>
                    <td class="hora-salida">{{ $ingreso->hora_salida ?? 'No registrado' }}</td>
                    <td class="motivo">{{ $ingreso->motivo }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="flex justify-center mt-4">
        @if ($historial->lastPage() > 1)
            <ul class="flex list-none">
                {{-- Enlaces de paginación --}}
                @for ($i = 1; $i <= $historial->lastPage(); $i++)
                    <li class="{{ $historial->currentPage() == $i ? 'bg-blue-500 text-white' : 'mr-2' }}">
                        <a href="{{ $historial->appends(['fecha_inicio' => $request->input('fecha_inicio'), 'fecha_fin' => $request->input('fecha_fin')])->url($i) }}" class="hover:bg-gray-200 px-3 py-2 rounded">{{ $i }}</a>
                    </li>
                @endfor
            </ul>
        @endif
    </div>

</body>

</html>
