@extends('layouts.layout')

@section('content')
    <div class="container mx-auto my-8 px-4">
        <h1 class="text-2xl font-bold mb-4">Estado del pedido con<br> número de transacción {{ $pedido->nro_transaccion }}</h1>

        <div class="bg-white shadow-md rounded p-4 mb-6">
            <div class="flex justify-between items-center">
                <p><strong>Producto:</strong> {{ $pedido->producto->nombre }}</p>
                <p><strong>Total:</strong> S/ {{ number_format($pedido->total, 2) }}</p>
            </div>

            <!-- Barra de Progreso -->
            <div class="mt-4">
                @php
                    $estados = ['en cola', 'en preparación', 'en camino', 'entregado'];
                    $estadoActual = $pedido->estado; // Estado actual del pedido
                    $estadoActualIndex = array_search($estadoActual, $estados); // Índice del estado actual
                @endphp

                <div class="relative flex items-center">
                    @foreach ($estados as $index => $estado)
                        <div class="flex items-center">
                            <div class="w-10 h-10 flex items-center justify-center 
                                {{ $index <= $estadoActualIndex ? 'bg-blue-500 text-white' : 'bg-gray-300 text-gray-700' }}
                                rounded-full font-bold">
                                {{ $index + 1 }}
                            </div>
                            <span class="ml-2 text-sm {{ $index === $estadoActualIndex ? 'font-bold text-blue-600' : 'text-gray-500' }}">
                                {{ ucfirst($estado) }}
                            </span>
                        </div>

                        @if ($index < count($estados) - 1)
                            <div class="flex-1 h-1 mx-2 {{ $index < $estadoActualIndex ? 'bg-blue-500' : 'bg-gray-300' }}"></div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Botón para volver a la lista de pedidos -->
        <a href="{{ route('mis.pedidos') }}" class="text-blue-500 hover:underline">
            Volver a Mis Pedidos
        </a>
    </div>
@endsection
