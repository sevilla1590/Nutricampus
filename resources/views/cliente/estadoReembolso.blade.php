@extends('layouts.layout')

@section('content')
<div class="container mx-auto py-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Estado del Reembolso</h3>

        <!-- Mostrar detalles del reembolso -->
        <div class="mb-4">
            <p><strong>Motivo:</strong> {{ $reembolso->motivo }}</p>
            <p><strong>Monto solicitado:</strong> S/ {{ number_format($reembolso->monto, 2) }}</p>
            <p><strong>Estado:</strong> 
                <span class="text-sm {{ $reembolso->estado === 'pendiente' ? 'text-yellow-600' : ($reembolso->estado === 'aprobado' ? 'text-green-600' : 'text-red-600') }}">
                    {{ ucfirst($reembolso->estado) }}
                </span>
            </p>
            <p><strong>Respuesta:</strong> {{ $reembolso->respuesta ?? 'Aún no hay una respuesta dada'}}</p>
            <p><strong>Fecha de solicitud:</strong> {{ \Carbon\Carbon::parse($reembolso->fecha_reembolso)->format('d-m-Y') }}</p>
            </div>
        <!-- Botón para volver a los pedidos -->
        <a href="{{ route('mis.pedidos', ['pedidoId' => $pedido->id]) }}" 
           class="inline-block mt-4 px-4 py-2 text-white bg-blue-500 hover:bg-blue-600 rounded-lg font-medium text-sm transition duration-300">
            Volver a Mis Pedidos
        </a>
    </div>
</div>
@endsection
