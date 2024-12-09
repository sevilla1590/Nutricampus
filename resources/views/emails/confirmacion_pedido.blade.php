<!DOCTYPE html>  
<html lang="es">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Confirmación de Pedido</title>  
</head>  
<body>  
    <h1>¡Gracias por tu pedido, {{ $pedido->cliente->nombre }}!</h1>  
    <p>Hemos recibido tu pedido con los siguientes detalles:</p>  

    <ul>  
        @foreach ($pedido->detalles as $detalle)  
            <li>{{ $detalle->producto->nombre }} - Cantidad: {{ $detalle->cantidad }} - Subtotal: S/ {{ number_format($detalle->subtotal, 2) }}</li>  
        @endforeach  
    </ul>  

    <p><strong>Total: S/ {{ number_format($pedido->total, 2) }}</strong></p>  

    <p>Pronto recibirás más actualizaciones sobre el estado de tu pedido.</p>  
    <p>Gracias por confiar en Nutricampus.</p>  
</body>  
</html>  