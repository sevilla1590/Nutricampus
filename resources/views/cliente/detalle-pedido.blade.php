@extends('layouts.layout')

@section('content')
    <div class="container mx-auto my-8 px-4">
        <div class="bg-gray-100 rounded-lg shadow-lg p-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Detalle del Pedido</h1>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Pedido #{{ $pedido->id }}</h2>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600"><strong>Número de Transacción:</strong> {{ $pedido->nro_transaccion }}</p>
                        <p class="text-gray-600"><strong>Total:</strong> <span class="text-green-600 font-bold">S/ {{ number_format($pedido->total, 2) }}</span></p>
                        <p class="text-gray-600"><strong>Método de Pago:</strong> {{ $pedido->metodoPago->tipo ?? 'Método no especificado' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600"><strong>Estado:</strong> <span class="text-blue-500 font-semibold">{{ $pedido->estado }}</span></p>
                        <p class="text-gray-600"><strong>Estado de Pago:</strong> <span class="text-green-500 font-semibold">{{ $pedido->estado_pago }}</span></p>
                    </div>
                </div>

                <div class="mt-4 border-t pt-4">
                    <p class="text-gray-600"><strong>Fecha de Creación:</strong> {{ $pedido->created_at }}</p>
                    <p class="text-gray-600"><strong>Última Actualización:</strong> {{ $pedido->updated_at }}</p>
                </div>
            </div>

            <div class="mt-6 bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-700 mb-4">Detalles de los Productos</h3>

                @if ($pedido->detalles->count())
                    <div class="divide-y">
                        @foreach ($pedido->detalles as $detalle)
                            <div class="py-4 flex justify-between items-center">
                                <div>
                                    <p class="text-gray-800 font-medium">Producto: {{ $detalle->producto->nombre ?? 'Producto no encontrado' }}</p>
                                    <p class="text-gray-600">Cantidad: {{ $detalle->cantidad }}</p>
                                </div>
                                <div>
                                    <p class="text-green-600 font-bold">S/ {{ number_format($detalle->subtotal, 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">No hay productos asociados a este pedido.</p>
                @endif
            </div>

            <div class="mt-6 text-center">
                <a href="{{ route('mis.pedidos') }}" class="inline-block px-6 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-md font-semibold transition duration-300">
                    Volver a la lista de pedidos
                </a>
            </div>
        </div>
    </div>
@endsection
