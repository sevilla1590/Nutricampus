@extends('layouts.layout')

@section('content')
    <div class="max-w-4xl mx-auto my-12 px-4">
        <!-- Header con número de pedido y total -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Número de Pedido</p>
                    <h1 class="text-2xl font-bold text-gray-900">#{{ $pedido->nro_transaccion }}</h1>
                </div>
                <div class="text-right">
                    <p class="text-gray-500 text-sm mb-1">Total del Pedido</p>
                    <p class="text-2xl font-bold text-green-600">S/ {{ number_format($pedido->total, 2) }}</p>
                </div>
            </div>
        </div>

        <!-- Estado del Pedido -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-8">Estado del Pedido</h2>

            <div class="mt-4">
                @php
                    $estados = ['en cola', 'en preparación', 'en camino', 'entregado'];
                    $estadoActual = strtolower($pedido->estado);
                    $estadoActualIndex = array_search($estadoActual, $estados);

                    // Array de imágenes correspondientes a cada estado
                    $imagenes = [
                        'idea.png', // en cola
                        'chef.png', // en preparación
                        'chamo.png', // en camino
                        'entrega.png', // entregado
                    ];
                @endphp

                <div class="relative flex items-center">
                    @foreach ($estados as $index => $estado)
                        <div class="flex flex-col items-center">
                            <!-- Círculo con imagen -->
                            <div
                                class="w-16 h-16 flex items-center justify-center   
                            {{ $index <= $estadoActualIndex ? 'bg-blue-500' : 'bg-gray-200' }}  
                            rounded-full transition-all duration-300 relative">
                                <img src="{{ asset('images/' . $imagenes[$index]) }}" alt="{{ ucfirst($estado) }}"
                                    class="w-10 h-10 object-contain {{ $index <= $estadoActualIndex ? 'brightness-0 invert' : 'opacity-50' }}">
                            </div>

                            <!-- Texto del estado -->
                            <span
                                class="mt-2 text-sm {{ $index === $estadoActualIndex ? 'font-bold text-blue-600' : 'text-gray-500' }}">
                                {{ ucfirst($estado) }}
                            </span>
                        </div>

                        <!-- Línea conectora -->
                        @if ($index < count($estados) - 1)
                            <div class="flex-1 h-1 mx-2 {{ $index < $estadoActualIndex ? 'bg-blue-500' : 'bg-gray-200' }}">
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Botón volver -->
        <div class="mt-8">
            <a href="{{ route('mis.pedidos') }}"
                class="inline-flex items-center text-blue-500 hover:text-blue-600 hover:underline">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Volver a Mis Pedidos
            </a>
        </div>
    </div>

    <style>
        /* Asegura una transición suave para los cambios de estado */
        .transition-all {
            transition: all 0.3s ease-in-out;
        }
    </style>
@endsection
