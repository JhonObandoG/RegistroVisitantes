<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Visitantes</title>

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

        .container {
            background-color: rgba(128, 0, 128, 0.1);
            border-radius: 0;
            box-shadow: 0 8px 16px rgba(128, 0, 128, 0.8);
            padding: 20px;
            text-align: center;
            max-width: 400px;
            width: 100%;
            margin: 20px;
        }

        h1,
        p {
            color: #fff;
        }

        form {
            margin-top: 20px;
        }

        .form-control {
            background-color: #fff;
            color: #000;
        }

        .btn-primary {
            background-color: #800080;
            border-color: #800080;
        }

        #registro-mensaje {
            color: #fff;
        }

        .btn-link {
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="{{ asset('logo.svg') }}" alt="Logo Valencia Producciones" style="width: 150px; height: auto;">
        <h1 class="mt-4">Registro de Visitantes</h1>
        <p>Bienvenido al registro de visitantes de Valencia Producciones. Ingresa tu número de documento para registrar
            tu visita o confirmar su salida.</p>
        <form action="{{ route('procesar.autenticacion') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" name="documento" class="form-control" placeholder="Número de Documento"
                    pattern="[0-9]{8,10}" title="Debe contener entre 8 y 10 dígitos numéricos" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
        </form>

        @if (isset($noRegistrado) && $noRegistrado)
            <p id="registro-mensaje">El número de documento no está registrado.</p>
            <a href="{{ route('registro') }}" class="mt-2 btn btn-link btn-block">Registrarse</a>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
