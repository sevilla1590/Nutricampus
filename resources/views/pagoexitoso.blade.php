@extends('layouts.layout')  

@section('content')  
<div class="container mx-auto my-8 px-4 max-w-3xl">  
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">  
        <!-- Encabezado -->  
        <div class="bg-green-500 p-6">  
            <h1 class="text-3xl font-bold text-white text-center">  
                <i class="fas fa-check-circle mr-2"></i>¡Pago Exitoso!  
            </h1>  
        </div>  

        <!-- Información principal -->  
        <div class="p-6 space-y-6">  
            <!-- Detalles de la transacción -->  
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">  
                <div class="space-y-3">  
                    <div class="flex items-center space-x-2">  
                        <span class="text-gray-600 font-medium">Código de Transacción:</span>  
                        <span class="text-gray-800">{{ $payment_id }}</span>  
                    </div>  
                    <div class="flex items-center space-x-2">  
                        <span class="text-gray-600 font-medium">Estado del Pago:</span>  
                        <span class="px-2 py-1 rounded-full text-sm   
                            {{ $status === 'Completado' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">  
                            {{ $status }}  
                        </span>  
                    </div>  
                    <div class="flex items-center space-x-2">  
                        <span class="text-gray-600 font-medium">Método de Pago:</span>  
                        <span class="text-gray-800">{{ $payment_type }}</span>  
                    </div>  
                </div>  
                <div class="space-y-3">  
                    <div class="flex items-center space-x-2">  
                        <span class="text-gray-600 font-medium">Cliente:</span>  
                        <span class="text-gray-800">{{ $cliente }}</span>  
                    </div>  
                    <div class="flex items-center space-x-2">  
                        <span class="text-gray-600 font-medium">Fecha del Pago:</span>  
                        <span class="text-gray-800">{{ $fecha }}</span>  
                    </div>  
                    <div class="flex items-center space-x-2">  
                        <span class="text-gray-600 font-medium">Total:</span>  
                        <span class="text-xl font-bold text-green-600">S/ {{ number_format($total, 2) }}</span>  
                    </div>  
                </div>  
            </div>  

            <!-- Productos adquiridos -->  
            <div class="mt-6">  
                <h2 class="text-xl font-bold text-gray-800 mb-4">Productos Adquiridos</h2>  
                <div class="bg-gray-50 rounded-lg p-4">  
                    <div class="space-y-3">  
                        @foreach ($productos as $producto)  
                            <div class="flex items-center justify-between border-b border-gray-200 pb-3 last:border-0">  
                                <div class="flex items-center space-x-3">  
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm">  
                                        {{ $producto['cantidad'] }} unid.  
                                    </span>  
                                    <span class="text-gray-800">{{ $producto['nombre'] }}</span>  
                                </div>  
                                @if(isset($producto['precio']))  
                                    <span class="text-gray-600">  
                                        S/ {{ number_format($producto['precio'] * $producto['cantidad'], 2) }}  
                                    </span>  
                                @endif  
                            </div>  
                        @endforeach  
                    </div>  
                </div>  
            </div>  

            <!-- Estado del pedido -->  
            <div class="bg-gray-50 rounded-lg p-4">  
                <div class="flex items-center justify-between">  
                    <span class="text-gray-600 font-medium">Estado del Pedido:</span>  
                    <span class="px-3 py-1 rounded-full text-sm   
                        {{ $estado_pedido === 'Enviado' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800' }}">  
                        {{ $estado_pedido }}  
                    </span>  
                </div>  
            </div>  

            <!-- Botones de acción -->  
            <div class="flex justify-center space-x-4 mt-6">  
                <a href="{{ route('index') }}"   
                   class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg transition duration-200 flex items-center">  
                    <i class="fas fa-home mr-2"></i>  
                    Volver al Inicio  
                </a>  
                <a href="#"   
                   class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-2 rounded-lg transition duration-200 flex items-center">  
                    <i class="fas fa-download mr-2"></i>  
                    Descargar Comprobante  
                </a>  
            </div>  
        </div>  
    </div>  
</div>  
@endsection  