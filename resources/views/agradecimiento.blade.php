<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agradecimiento</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #000;
            margin: 30px 0;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            color: #fff;
        }

        .agradecimiento-container {
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 30px;
        }

        .btn-registrar-salida {
            background-color: #800080;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-registrar-salida:hover {
            background-color: #5a005a;
        }
    </style>
</head>

<body>
    <div class="agradecimiento-container">
        <h1>{{ isset($mensajeAgradecimiento) ? $mensajeAgradecimiento : '' }}</h1>
        <p>Agradecemos su registro. {{ isset($mensajeAdicional) ? $mensajeAdicional : '' }}</p>
        @if(isset($mostrarBotonSalida) && $mostrarBotonSalida)
            <button class="btn-registrar-salida" onclick="location.href='{{ route('mostrar.formulario.autenticacion') }}'">Finalizar</button>
        @endif
    </div>

    <!-- Agregamos enlaces a Bootstrap JS y Popper.js (si aún no están incluidos) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
