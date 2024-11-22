@extends('layouts.layout')

@section('content')
    <div class="container mx-auto my-8 px-4">
        <h1 class="text-2xl font-bold mb-4">Detalle del Pedido</h1>

        <div class="bg-white shadow-md rounded p-4">
            <p><strong>ID:</strong> {{ $pedido->id }}</p>
            <p><strong>Cliente:</strong> {{ $pedido->id_cliente }}</p>
            <p><strong>Fecha:</strong> {{ $pedido->fecha }}</p>
            <p><strong>Total:</strong> ${{ $pedido->total }}</p>
            <p><strong>Estado de pago:</strong> {{ $pedido->estado_pago }}</p>
            <p><strong>Ultimo cambio:</strong> {{ $pedido->updated_at }}</p>
            <p><strong>Estado:</strong> {{ $pedido->estado }}</p>
        </div>

        <a href="{{ route('pedidos.listar') }}" class="text-blue-500 hover:underline mt-4 block">
            Volver a la lista de pedidos
        </a>    
    </div>
@endsection
