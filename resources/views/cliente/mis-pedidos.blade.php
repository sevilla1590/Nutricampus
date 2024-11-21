@extends('layouts.layout')

@section('content')
    <div class="container mx-auto my-8 px-4">
        <h1 class="text-2xl font-bold mb-4">Mis Pedidos</h1>

        @foreach ($pedidos as $pedido)
            <div class="bg-white shadow-md rounded p-4 mb-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-bold">Pedido #{{ $pedido->id }}</h2>
                    <span class="text-sm text-gray-500">Fecha: {{ $pedido->fecha }}</span>
                </div>
                <p><strong>Producto:</strong> {{ $pedido->producto->nombre }}</p>
                <p><strong>Total:</strong> S/ {{ number_format($pedido->total, 2) }}</p>

                <!-- Texto explícito del estado actual -->
                <div class="mt-4">
                    <p class="text-center text-lg font-semibold text-blue-600">
                        Estado actual: {{ ucfirst($pedido->estado) }}
                    </p>
                </div>

                <!-- Barra de Progreso -->
                <div class="mt-4">
                    @php
                        // Define los estados posibles y calcula el índice del estado actual
                        $estados = ['en cola', 'en preparación', 'en camino', 'entregado'];
                        $estadoActual = $pedido->estado; // Estado del pedido desde la BD
                        $estadoActualIndex = array_search($estadoActual, $estados); // Índice del estado actual
                    @endphp

                    <!-- Contenedor de la barra de progreso -->
                    <div class="relative flex items-center">
                        @foreach ($estados as $index => $estado)
                            <!-- Círculo del estado -->
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

                            <!-- Línea entre los círculos -->
                            @if ($index < count($estados) - 1)
                                <div class="flex-1 h-1 mx-2 {{ $index < $estadoActualIndex ? 'bg-blue-500' : 'bg-gray-300' }}"></div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
