<!DOCTYPE html>
<html>
<head>
    <title>Confirmación de Salida</title>
</head>
<body>
    <h2>Confirmación de Salida</h2>

    <p>Resumen del Ingreso:</p>
    <ul>
        <li><strong>Nombre:</strong> {{ $historial->nombre }}</li>
        <li><strong>Apellido:</strong> {{ $historial->apellido }}</li>
        <li><strong>Documento:</strong> {{ $historial->documento }}</li>
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
</body>
</html>
