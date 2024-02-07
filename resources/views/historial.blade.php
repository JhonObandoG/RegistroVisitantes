<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Visitas</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            background-color: #000;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        h1 {
            margin-bottom: 20px;
        }

        .filtro-container {
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly;
            align-items: center;
        }

        .filtro-container label,
        .filtro-container input {
            margin: 5px;
            width: 100%;
        }

        .btn-container {
            display: flex;
            justify-content: space-evenly;
            width: 100%;
        }

        button,
        a {
            width: 45%;
            background-color: #800080;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }

        button:hover,
        a:hover {
            background-color: #600060;
        }

        table {
            width: auto;
            max-width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            word-wrap: break-word;
            color: #000;
        }

        th {
            background-color: #800080;
            color: #fff;
        }

        tbody tr:hover {
            background-color: #cccccc;
        }

        .flex {
            display: flex;
            justify-content: space-between;
        }

        ul {
            list-style: none;
            padding: 0;
            display: flex;
        }

        li {
            margin-right: 5px;
        }

        a {
            text-decoration: none;
            color: #fff;
            background-color: #800080;
            padding: 10px;
            border-radius: 5px;
            display: block;
            text-align: center;
        }

        a:hover {
            background-color: #600060;
        }

        .btn-quitar-filtro {
            background-color: #800080;
            color: #fff;
            margin-top: 10px;
            border-radius: 5px;
            padding: 10px;
            text-decoration: none;
            border: 1px solid #800080;
        }

        .btn-quitar-filtro:hover {
            background-color: #600060;
        }

        @media (max-width: 768px) {

            body {
                padding: 10px;
            }

            .filtro-container {
                flex-direction: column;
                align-items: center;
            }

            .filtro-container label,
            .filtro-container input {
                width: 100%;
            }

            .btn-container {
                flex-direction: column;
            }

            button,
            a,
            .btn-quitar-filtro {
                width: 100%;
                margin-top: 10px;
            }

            table {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <h1>Historial de Visitas</h1>

    <div class="filtro-container">
        <label for="fecha_inicio">Fecha de Inicio:</label>
        <input type="date" name="fecha_inicio" required>

        <label for="fecha_fin">Fecha de Fin:</label>
        <input type="date" name="fecha_fin" required>

        <div class="btn-container">
            <button type="submit">Filtrar</button>
            <a href="{{ route('mostrar.historial') }}" class="btn btn-primary btn-quitar-filtro">Quitar Filtro</a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nombre Completo</th>
                <th>tipo de documento</th>
                <th>Documento</th>
                <th>Fecha de Ingreso</th>
                <th>Hora de Ingreso</th>
                <th>Hora de Salida</th>
                <th>Motivo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($historial as $ingreso)
                <tr>
                    <td>{{ $ingreso->nombre }} {{ $ingreso->apellido }}</td>
                    <td>{{ $ingreso->tipo_documento }}</td>
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
                @for ($i = 1; $i <= $historial->lastPage(); $i++)
                    <li class="{{ $historial->currentPage() == $i ? 'bg-blue-500 text-white' : 'mr-2' }}">
                        <a href="{{ $historial->appends(['fecha_inicio' => $request->input('fecha_inicio'), 'fecha_fin' => $request->input('fecha_fin')])->url($i) }}"
                            class="hover:bg-gray-200 px-3 py-2 rounded">{{ $i }}</a>
                    </li>
                @endfor
            </ul>
        @endif
    </div>
</body>

</html>
