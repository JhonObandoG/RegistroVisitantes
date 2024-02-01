<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Ingreso</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/timepicker.js"></script>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f1f1f1;
            margin: 150px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            max-width: 400px;
            text-align: center;
            margin: 0 20px;
        }

        h1 {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            color: #555;
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
            transition: border-color 0.3s ease;
        }

        .form-group textarea {
            height: 100px;
            resize: none;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: #007bff;
            outline: none;
        }

        .form-group .form-control {
            width: calc(100% - 22px);
        }

        .btn-primary {
            background-color: #007bff;
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
            background-color: #0056b3;
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


        <label for="oficina">Oficina o Proyecto del que viene:</label>
        <select name="oficina" id="oficina" required>
            <option value="" disabled selected>Seleccione una opción</option>
            <option value="Valencia_Producciones" {{ $visitante->oficina == 'Valencia_Producciones' ? 'selected' : '' }}>Valencia Producciones</option>
            <option value="Stargate" {{ $visitante->oficina == 'Stargate' ? 'selected' : '' }}>Stargate</option>
            <option value="SMARTFILMS" {{ $visitante->oficina == 'SMARTFILMS' ? 'selected' : '' }}>SMARTFILMS</option>
            <option value="Visual_Music" {{ $visitante->oficina == 'Visual_Music' ? 'selected' : '' }}>Visual Music</option>
            <option value="Mauricio_Navas" {{ $visitante->oficina == 'Mauricio_Navas' ? 'selected' : '' }}>Mauricio Navas</option>
            <option value="Fundacion_Amados" {{ $visitante->oficina == 'Fundacion_Amados' ? 'selected' : '' }}>Fundacion Amados</option>
            <!-- Agrega más opciones según sea necesario -->
        </select>

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

        <button type="submit" class="btn-primary">Enviar</button>

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


    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/timepicker.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const primeraVez = {!! isset($primeraVez) ? json_encode($primeraVez) : 'false' !!};

            const horaActual = new Date();

            const fechaInput = flatpickr("#fecha", {
                enableTime: false,
                dateFormat: "Y-m-d",
                defaultDate: horaActual,
            });

            const horaInput = flatpickr("#hora", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                defaultDate: horaActual,
                minDate: "today",
                minuteIncrement: 1,
                minTime: horaActual.getHours() + ':' + horaActual.getMinutes(),
                maxTime: horaActual.getHours() + ':' + horaActual.getMinutes(),
            });

            fechaInput.config.onChange.push((selectedDates, dateStr) => {
                document.getElementById("fecha-hidden").value = dateStr;
            });


        });


    </script>
</body>

</html>
