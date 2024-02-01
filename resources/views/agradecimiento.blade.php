<!DOCTYPE html>
<html>
<head>
    <title>Agradecimiento</title>
    <style>
        .btn-registrar-salida {
            display: {{ isset($mostrarBotonSalida) && $mostrarBotonSalida ? 'block' : 'none' }};
        }
    </style>
</head>
<body>
    <div class="agradecimiento-container">
        <h1>{{ isset($mensajeAgradecimiento) ? $mensajeAgradecimiento : '' }}</h1>
        <p>Agradecemos su registro. {{ isset($mensajeAdicional) ? $mensajeAdicional : '' }}</p>
        @if(isset($mostrarBotonSalida) && $mostrarBotonSalida)
            <button class="btn-registrar-salida" onclick="location.href='{{ route('mostrar.formulario.autenticacion') }}'">Registrar Salida</button>
        @endif
    </div>
</body>
</html>
