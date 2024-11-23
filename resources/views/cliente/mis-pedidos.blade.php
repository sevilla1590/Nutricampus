@extends('layouts.layout')

@section('content')
    <div class="container mx-auto my-8 px-4">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Mis Pedidos</h1>

        @forelse ($pedidos as $pedido)
            <div class="relative bg-white rounded-lg shadow-lg p-6 mb-6 hover:shadow-xl transition-shadow duration-300">
                <!-- Tiempos en la esquina superior derecha -->
                <div class="absolute top-4 right-4 text-sm text-gray-500 text-right">
                    <p><strong>Creado el:</strong> {{ $pedido->created_at }}</p>
                    <p><strong>Última Actualización:</strong> {{ $pedido->updated_at }}</p>
                </div>

                <!-- Información del pedido -->
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Número de Transacción: 
                    <span class="text-gray-900">{{ $pedido->nro_transaccion }}</span>
                </h3>
                <p class="text-gray-600"><strong>Total:</strong> 
                    <span class="text-green-600 font-bold">S/ {{ number_format($pedido->total, 2) }}</span>
                </p>
                <p class="text-gray-600"><strong>Método de Pago:</strong> 
                    {{ $pedido->metodoPago->tipo ?? 'Método no especificado' }}
                </p>

                <!-- Acciones -->
                <div class="mt-4 flex space-x-4">
                    <a href="{{ route('pedido.estado', ['id' => $pedido->id]) }}" 
                       class="inline-block px-4 py-2 text-white bg-blue-500 hover:bg-blue-600 rounded-lg font-medium text-sm transition duration-300 shadow-md">
                        Ver Estado de Pedido
                    </a>
                    <a href="{{ route('pedido.detalle', ['id' => $pedido->id]) }}" 
                       class="inline-block px-4 py-2 text-white bg-indigo-500 hover:bg-indigo-600 rounded-lg font-medium text-sm transition duration-300 shadow-md">
                        Ver Detalle
                    </a>
                </div>
            </div>
        @empty
            <div class="text-center bg-gray-100 rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold text-gray-600">No tienes pedidos registrados.</h2>
                <p class="text-gray-500 mt-2">Cuando realices un pedido, podrás verlo aquí.</p>
            </div>
        @endforelse
    </div>
@endsection
