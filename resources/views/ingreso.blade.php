<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Ingreso</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/timepicker.js"></script>

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
        }

        form {
            background-color: rgba(128, 0, 128, 0.1);
            border-radius: 0;
            box-shadow: 0 8px 16px rgba(128, 0, 128, 0.8);
            padding: 20px;
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            color: #fff;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            color: #fff;
            display: block;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s ease, color 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: #800080;
            outline: none;
        }

        .form-group input:-webkit-autofill,
        .form-group textarea:-webkit-autofill,
        .form-group select:-webkit-autofill {
            box-shadow: 0 0 0 30px #fff inset ;
            -webkit-text-fill-color: #000 ;
        }

        .form-group .form-control {
            width: calc(100% - 22px);
        }

        .btn-primary {
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

        .btn-primary:hover {
            background-color: #5a005a;
        }

        .alert {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            margin-top: 15px;
            width: 100%;
            text-align: center;
            opacity: 1;
            animation: fadeOut 5s forwards;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        @keyframes fadeOut {
            0% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }

        .form-control.readonly {
            background-color: #eee;
            pointer-events: none;
        }
    </style>
</head>

<body>

    <form action="{{ route('procesar.formulario') }}" method="POST">
        @csrf

        <h1>Formulario de Ingreso</h1>

        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="{{ $visitante->nombre ?? '' }}"
                class="form-control">
        </div>

        <div class="form-group">
            <label for="apellido">Apellido:</label>
            <input type="text" name="apellido" id="apellido" value="{{ $visitante->apellido ?? '' }}"
                class="form-control">
        </div>

        <div class="form-group">
            <label for="documento">Documento:</label>
            <input type="text" name="documento" id="documento" value="{{ $visitante->documento ?? '' }}"
                class="form-control readonly" readonly>
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" id="telefono" value="{{ $visitante->telefono ?? '' }}"
                class="form-control">
        </div>

        <div class="form-group">
            <label for="oficina">Oficina o Proyecto del que viene:</label>
            <select name="oficina" id="oficina" required class="form-control">
                <option value="" disabled selected>Seleccione una opción</option>
                <option value="Valencia_Producciones" {{ $visitante->oficina == 'Valencia_Producciones' ? 'selected' : '' }}>Valencia Producciones</option>
                <option value="Stargate" {{ $visitante->oficina == 'Stargate' ? 'selected' : '' }}>Stargate</option>
                <option value="SMARTFILMS" {{ $visitante->oficina == 'SMARTFILMS' ? 'selected' : '' }}>SMARTFILMS</option>
                <option value="Visual_Music" {{ $visitante->oficina == 'Visual_Music' ? 'selected' : '' }}>Visual Music</option>
                <option value="Mauricio_Navas" {{ $visitante->oficina == 'Mauricio_Navas' ? 'selected' : '' }}>Mauricio Navas</option>
                <option value="Fundacion_Amados" {{ $visitante->oficina == 'Fundacion_Amados' ? 'selected' : '' }}>Fundacion Amados</option>
                <!-- Agrega más opciones según sea necesario -->
            </select>
        </div>

        <div class="form-group">
            <label for="fecha">Fecha:</label>
            <input type="text" name="fecha" id="fecha" class="form-control readonly" readonly>
            <input type="hidden" name="fecha-hidden" id="fecha-hidden">
        </div>

        <div class="form-group">
            <label for="hora">Hora:</label>
            <input type="text" name="hora" id="hora" class="form-control readonly" readonly>
        </div>

        <div class="form-group">
            <label for="a_quien_visita">A quien visita:</label>
            <input type="text" name="a_quien_visita" class="form-control" pattern="[A-Za-záéíóúÁÉÍÓÚñÑüÜ\s]+"
                title="Solo se permiten letras y espacios" value="{{ old('a_quien_visita') }}">
        </div>

        <div class="form-group">
            <label for="motivo">Motivo:</label>
            <textarea name="motivo" id="motivo" class="form-control" rows="3" pattern="[A-Za-z0-9\s]+"
                title="Solo se permiten letras, números y espacios">{{ old('motivo') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>

        @if ($errors->any())
            <div class="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const horaActual = new Date();

            flatpickr("#fecha", {
                enableTime: false,
                dateFormat: "Y-m-d",
                defaultDate: horaActual,
            });

            flatpickr("#hora", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                defaultDate: horaActual,
                minDate: "today",
                minuteIncrement: 1,
                minTime: horaActual.getHours() + ':' + horaActual.getMinutes(),
                maxTime: horaActual.getHours() + ':' + horaActual.getMinutes(),
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
