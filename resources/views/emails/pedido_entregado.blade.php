<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido Entregado</title>
</head>

<body>
    <h1>¡Hola, {{ $pedido->cliente->nombre }}!</h1>
    <p>Nos complace informarte que tu pedido ha sido entregado con éxito.</p>

    <h3>Detalles del Pedido:</h3>
    <ul>
        @foreach ($pedido->detalles as $detalle)
            <li>{{ $detalle->producto->nombre }} - Cantidad: {{ $detalle->cantidad }} - Subtotal: S/
                {{ number_format($detalle->subtotal, 2) }}</li>
        @endforeach
    </ul>

    <p><strong>Total: S/ {{ number_format($pedido->total, 2) }}</strong></p>

    <p>Gracias por confiar en NutriCampus. ¡Esperamos verte pronto!</p>
</body>

</html>
