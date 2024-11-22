@extends('layouts.layout')

@section('content')
<div class="container mx-auto my-8 px-4">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">¡Pago Exitoso!</h1>
    <div class="bg-white rounded-lg shadow-lg p-6">
        <p><strong>Código de Transacción:</strong> {{ $payment_id }}</p>
        <p><strong>Estado del Pago:</strong> {{ $status }}</p>
        <p><strong>Método de Pago:</strong> {{ $payment_type }}</p>
        <p><strong>Cliente:</strong> {{ $cliente }}</p>
        <p><strong>Fecha del Pago:</strong> {{ $fecha }}</p>
        <p><strong>Total:</strong> S/ {{ $total }}</p>
        <h2 class="mt-4 font-bold text-lg">Productos Adquiridos:</h2>
        <ul class="list-disc ml-6">
            @foreach ($productos as $index => $producto)
                <li>Producto ({{ $index + 1 }}): {{ $producto['nombre'] }}</li>
            @endforeach
        </ul>
        <p class="mt-4"><strong>Estado del Pedido:</strong> {{ $estado_pedido }}</p>
        <div class="mt-6">
            <a href="{{ route('index') }}" class="bg-green-500 text-white px-4 py-2 rounded">Volver al Inicio</a>
        </div>
    </div>
</div>
@endsection