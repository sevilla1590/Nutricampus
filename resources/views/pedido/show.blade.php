@extends('layouts.layout')

@section('content')
    <div class="container mx-auto my-8 px-4">
        <h1 class="text-2xl font-bold mb-4">Detalle del Pedido</h1>

        <div class="bg-white rounded-lg shadow-md p-4 mb-4">
            <h2 class="text-lg font-bold">Número de Transacción: {{ $pedido->nro_transaccion }}</h2>
            <p><strong>Fecha:</strong> {{ $pedido->created_at }}</p>
            <p><strong>Total:</strong> S/ {{ number_format($pedido->total, 2) }}</p>
            <p><strong>Estado de pago:</strong> {{ $pedido->estado_pago }}</p>
            <p><strong>Último cambio:</strong> {{ $pedido->updated_at }}</p>
            <p><strong>Estado:</strong> {{ $pedido->estado }}</p>
        </div>

        <h2 class="text-lg font-bold mt-8 mb-4">Productos del Pedido</h2>
        <div class="bg-white rounded-lg shadow-md p-4">
            @if ($pedido->detalles->isEmpty())
                <p>No hay productos asociados a este pedido.</p>
            @else
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="border-b px-4 py-2">Producto</th>
                            <th class="border-b px-4 py-2">Cantidad</th>
                            <th class="border-b px-4 py-2">Precio Unitario</th>
                            <th class="border-b px-4 py-2">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedido->detalles as $detalle)
                            <tr>
                                <td class="border-b px-4 py-2">{{ $detalle->producto->nombre ?? 'Producto no disponible' }}</td>
                                <td class="border-b px-4 py-2">{{ $detalle->cantidad }}</td>
                                <td class="border-b px-4 py-2">S/ {{ number_format($detalle->precio_unitario, 2) }}</td>
                                <td class="border-b px-4 py-2">S/ {{ number_format($detalle->cantidad * $detalle->precio_unitario, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <a href="{{ route('pedidos.listar') }}" class="text-blue-500 hover:underline mt-4 block">Volver a la lista de pedidos</a>
    </div>
@endsection
