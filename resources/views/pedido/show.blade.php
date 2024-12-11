@extends('layouts.admin')

@section('content')
    <div class="container mx-auto my-4 sm:my-8 px-4 max-w-5xl">
        <!-- Encabezado -->
        <br>
        <br>
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Detalle del Pedido</h1>
            <a href="{{ route('pedidos.listar') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-300 flex items-center text-sm sm:text-base w-full sm:w-auto justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                Volver a pedidos
            </a>
        </div>

        <!-- Información del Pedido -->
        <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 mb-6">
            <div class="grid grid-cols-1 gap-4">
                <!-- Detalles principales -->
                <div class="space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center border-b pb-3">
                        <span class="text-gray-600 font-medium sm:w-48 mb-1 sm:mb-0">Nº Transacción:</span>
                        <span class="text-gray-800 font-bold">{{ $pedido->nro_transaccion }}</span>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center border-b pb-3">
                        <span class="text-gray-600 font-medium sm:w-48 mb-1 sm:mb-0">Fecha:</span>
                        <span class="text-gray-800">{{ $pedido->created_at->format('d/m/Y H:i') }}</span>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center border-b pb-3">
                        <span class="text-gray-600 font-medium sm:w-48 mb-1 sm:mb-0">Último cambio:</span>
                        <span class="text-gray-800">{{ $pedido->updated_at->format('d/m/Y H:i') }}</span>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center border-b pb-3">
                        <span class="text-gray-600 font-medium sm:w-48 mb-1 sm:mb-0">Total:</span>
                        <span class="text-gray-800 font-bold text-lg">S/ {{ number_format($pedido->total, 2) }}</span>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center border-b pb-3">
                        <span class="text-gray-600 font-medium sm:w-48 mb-1 sm:mb-0">Estado de pago:</span>
                        <span
                            class="px-3 py-1 rounded-full text-sm font-medium inline-block  
                        @if ($pedido->estado_pago == 'Pagado') bg-green-100 text-green-800  
                        @elseif($pedido->estado_pago == 'Pendiente')  
                            bg-yellow-100 text-yellow-800  
                        @else  
                            bg-red-100 text-red-800 @endif">
                            {{ $pedido->estado_pago }}
                        </span>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center pb-3">
                        <span class="text-gray-600 font-medium sm:w-48 mb-1 sm:mb-0">Estado:</span>
                        <span
                            class="px-3 py-1 rounded-full text-sm font-medium inline-block  
                        @if ($pedido->estado == 'Completado') bg-green-100 text-green-800  
                        @elseif($pedido->estado == 'En proceso')  
                            bg-blue-100 text-blue-800  
                        @else  
                            bg-gray-100 text-gray-800 @endif">
                            {{ $pedido->estado }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Productos del Pedido -->
        <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 sm:mb-6">Productos del Pedido</h2>
            @if ($pedido->detalles->isEmpty())
                <p class="text-gray-500 text-center py-4">No hay productos asociados a este pedido.</p>
            @else
                <!-- Tabla para pantallas medianas y grandes -->
                <div class="hidden sm:block overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Producto</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Cantidad</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Precio Unit.</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($pedido->detalles as $detalle)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-4 text-sm font-medium text-gray-900">
                                        {{ $detalle->producto->nombre ?? 'Producto no disponible' }}
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-500">
                                        {{ $detalle->cantidad }}
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-500">
                                        S/ {{ number_format($detalle->precio_unitario, 2) }}
                                    </td>
                                    <td class="px-4 py-4 text-sm font-medium text-gray-900">
                                        S/ {{ number_format($detalle->cantidad * $detalle->precio_unitario, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Vista de tarjetas para móviles -->
                <div class="sm:hidden space-y-4">
                    @foreach ($pedido->detalles as $detalle)
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-900 mb-2">
                                {{ $detalle->producto->nombre ?? 'Producto no disponible' }}
                            </h3>
                            <div class="grid grid-cols-2 gap-2 text-sm">
                                <div>
                                    <span class="text-gray-500">Cantidad:</span>
                                    <span class="font-medium ml-1">{{ $detalle->cantidad }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-500">Precio Unit.:</span>
                                    <span class="font-medium ml-1">S/
                                        {{ number_format($detalle->precio_unitario, 2) }}</span>
                                </div>
                                <div class="col-span-2">
                                    <span class="text-gray-500">Subtotal:</span>
                                    <span class="font-medium ml-1">S/
                                        {{ number_format($detalle->cantidad * $detalle->precio_unitario, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
