<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Salida</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            background-color: #000;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            background-color: rgba(128, 0, 128, 0.1);
            border-radius: 0;
            box-shadow: 0 8px 16px rgba(128, 0, 128, 0.8);
            padding: 20px;
            text-align: center;
            max-width: 400px;
            width: 100%;
            margin: 20px;
        }

        h2,
        p {
            color: #fff;
            margin-bottom: 20px;
        }

        .info-list {
            list-style-type: none;
            padding: 0;
            text-align: left;
        }

        .info-list li {
            margin-bottom: 10px;
        }

        button {
            background-color: #800080;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
            margin-top: 15px;
        }

        button:hover {
            background-color: #5a005a;
        }
    </style>
</head>

<body>
    <div class="card">
        <h2>Confirmación de Salida</h2>

        <ul class="info-list">
            <li><strong>Nombres:</strong> {{ $historial->nombre }}</li>
            <li><strong>Apellidos:</strong> {{ $historial->apellido }}</li>
            <li><strong>Documento:</strong> {{ $historial->documento }}</li>
            <li><strong>Tipo de documento:</strong> {{ $historial->tipo_documento }}</li>
            <li><strong>Oficina/Proyecto:</strong> {{ $historial->oficina }}</li>
            <li><strong>Motivo:</strong> {{ $historial->motivo }}</li>
            <li><strong>A quien visita:</strong> {{ $historial->a_quien_visita }}</li>
            <li><strong>Hora de Entrada:</strong> {{ $historial->hora_ingreso }}</li>
        </ul>

        <p>¿Estás seguro de registrar la salida?</p>

        <form method="POST" action="{{ route('procesar.salida', ['documento' => $historial->documento]) }}">
            @csrf
            <button type="submit">Confirmar Salida</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
