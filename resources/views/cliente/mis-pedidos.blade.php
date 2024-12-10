@extends('layouts.layout')

@section('content')
    <div class="container mx-auto my-8 px-4 max-w-6xl">
        <h1 class="text-4xl font-bold mb-8 text-center text-gray-800 animate-fade-in">
            Mis Pedidos
            <div class="h-1 w-24 bg-blue-500 mx-auto mt-2 rounded-full"></div>
        </h1>

        @forelse ($pedidos as $pedido)
            <div
                class="relative bg-white rounded-xl shadow-md p-6 mb-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100">
                <!-- Badge de estado -->
                <div class="absolute -top-3 left-6 px-4 py-1 bg-blue-500 text-white text-sm font-medium rounded-full">
                    Pedido #{{ $pedido->nro_transaccion }}
                </div>

                <!-- Tiempos con iconos -->
                <div class="absolute top-4 right-4 text-sm text-gray-500 text-right">
                    <p class="flex items-center justify-end gap-2 mb-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ $pedido->created_at->format('d/m/Y H:i') }}
                    </p>
                    <p class="flex items-center justify-end gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $pedido->updated_at->diffForHumans() }}
                    </p>
                </div>

                <!-- Información del pedido -->
                <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="flex items-center space-x-3">
                        <div class="p-3 bg-blue-100 rounded-lg">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Transacción</p>
                            <p class="font-semibold text-gray-800">{{ $pedido->nro_transaccion }}</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-3">
                        <div class="p-3 bg-green-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total</p>
                            <p class="font-semibold text-green-600">S/ {{ number_format($pedido->total, 2) }}</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-3">
                        <div class="p-3 bg-purple-100 rounded-lg">
                            <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Método de Pago</p>
                            <p class="font-semibold text-gray-800">{{ $pedido->metodoPago->tipo ?? 'No especificado' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Acciones -->
                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ route('pedido.estado', ['id' => $pedido->id]) }}"
                        class="flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                        Estado del Pedido
                    </a>

                    <a href="{{ route('pedido.detalle', ['id' => $pedido->id]) }}"
                        class="flex items-center px-4 py-2 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600 transition-colors duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        Ver Detalle
                    </a>

                    <a href="{{ route('reembolsos.create', ['pedidoId' => $pedido->id]) }}"
                        class="flex items-center px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                        </svg>
                        Pedir Reembolso
                    </a>

                    <a href="{{ route('reembolsos.estado', ['pedidoId' => $pedido->id]) }}"
                        class="flex items-center px-4 py-2 bg-purple-500 text-white rounded-lg hover:bg-purple-600 transition-colors duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Revisar Reembolso
                    </a>
                </div>
            </div>
        @empty
            <div class="text-center bg-gray-50 rounded-xl shadow-md p-8 border border-gray-200">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                </svg>
                <h2 class="mt-4 text-xl font-semibold text-gray-700">No tienes pedidos registrados</h2>
                <p class="mt-2 text-gray-500">Cuando realices un pedido, podrás verlo aquí.</p>
                <a href="{{ route('productos.index') }}"
                    class="inline-block mt-4 px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-300">
                    Explorar Productos
                </a>
            </div>
        @endforelse
    </div>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.5s ease-out;
        }
    </style>
@endsection
