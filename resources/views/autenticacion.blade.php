<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Visitantes</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            color: #555;
            text-align: center;
            margin-bottom: 20px;
            max-width: 400px;
            line-height: 1.5;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 300px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        a {
            color: #007bff;
            text-decoration: none;
            margin-top: 10px;
        }

        a:hover {
            text-decoration: underline;
        }

        @if (isset($noRegistrado) && $noRegistrado)
            #registro-mensaje {
                color: #ff0000;
                margin-top: 10px;
            }
        @endif
    </style>
</head>

<body>
    <h1>Registro de Visitantes</h1>
    <p>Bienvenido al registro de visitantes de Valencia Producciones. Ingresa tu número de documento para registrar tu
        visita o confirmar su salida.</p>
    <form action="{{ route('procesar.autenticacion') }}" method="POST">
        @csrf
        <input type="text" name="documento" placeholder="Número de Documento" pattern="[0-9]{8,10}"
            title="Debe contener entre 8 y 10 dígitos numéricos" required>
        <button type="submit">Ingresar</button>
    </form>

    @if (isset($noRegistrado) && $noRegistrado)
        <p id="registro-mensaje">El número de documento no está registrado.</p>
        <a href="{{ route('registro') }}">Registrarse</a>
    @endif
</body>

</html>
