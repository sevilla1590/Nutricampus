@extends('layouts.layout')

@section('content')
    <div class="container mx-auto my-8 px-4">
        <h1 class="text-2xl font-bold mb-4">Mis Pedidos</h1>

        @foreach ($pedidos as $pedido)
            <div class="bg-white shadow-md rounded p-4 mb-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-bold">Número de transacción {{ $pedido->nro_transaccion }}</h2>
                    <span class="text-sm text-gray-500">Fecha de creación: {{ $pedido->fecha }}
                        <br>
                        <span class="text-sm text-gray-500">Última actualización: {{ $pedido->updated_at }}</span>
                    </span>
                </div>
                <p><strong>Producto:</strong> {{ $pedido->producto->nombre }}</p>
                <p><strong>Total:</strong> S/ {{ number_format($pedido->total, 2) }}</p>

                <!-- Botón para ver el estado del pedido -->
                <div class="mt-4">
                <a href="{{ route('pedido.estado', $pedido->id) }}" class="text-blue-500 hover:underline">Ver estado de pedido</a>

                </div>
            </div>
        @endforeach
    </div>
@endsection
