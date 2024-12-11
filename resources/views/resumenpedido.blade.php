@extends('layouts.layout')

@section('content')
    <div class="container mx-auto my-8 px-4 max-w-4xl">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Encabezado -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                <h1 class="text-2xl md:text-3xl font-bold text-white">Resumen del Pedido</h1>
            </div>

            <!-- Contenido -->
            <div class="p-6">
                <!-- Tabla de productos -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-6 py-4 text-sm font-medium text-gray-500 uppercase tracking-wider text-left">
                                    Producto
                                </th>
                                <th class="px-6 py-4 text-sm font-medium text-gray-500 uppercase tracking-wider text-center">
                                    Cantidad
                                </th>
                                <th class="px-6 py-4 text-sm font-medium text-gray-500 uppercase tracking-wider text-right">
                                    Precio
                                </th>
                                <th class="px-6 py-4 text-sm font-medium text-gray-500 uppercase tracking-wider text-right">
                                    Subtotal
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($carrito as $item)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            @if (isset($item['imagen']))
                                                <img src="{{ asset($item['imagen']) }}" alt="{{ $item['nombre'] }}"
                                                    class="w-12 h-12 object-cover rounded-lg mr-4">
                                            @endif
                                            <span class="font-medium text-gray-900">{{ $item['nombre'] }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                            {{ $item['cantidad'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-gray-900">
                                        S/ {{ number_format($item['precio'], 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right font-medium text-gray-900">
                                        S/ {{ number_format($item['precio'] * $item['cantidad'], 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Resumen y botón de pago -->
                <div class="mt-8 border-t border-gray-200 pt-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                        <div class="flex flex-col">
                            <span class="text-gray-500 text-sm">Total a pagar</span>
                            <span class="text-3xl font-bold text-gray-900">
                                S/ {{ number_format($total, 2) }}
                            </span>
                        </div>
                        <button id="pagar"
                            class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-150 shadow-sm hover:shadow-md">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd" />
                            </svg>
                            Pagar con Mercado Pago
                        </button>
                    </div>
                </div>

                <!-- Información adicional -->
                <div class="mt-8 bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center text-sm text-gray-500">
                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        El pago será procesado de forma segura a través de Mercado Pago
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
        const mp = new MercadoPago("{{ env('MERCADOPAGO_PUBLIC_KEY') }}");

        document.getElementById('pagar').addEventListener('click', function() {
            mp.checkout({
                preference: {
                    id: "{{ $preference->id }}"
                },
                autoOpen: true,
            });
        });
    </script>
@endsection
