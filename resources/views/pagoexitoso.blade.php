@extends('layouts.layout')

@section('content')
<div class="container mx-auto my-8 px-4">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">¡Pago Exitoso!</h1>
    <div class="bg-white rounded-lg shadow-lg p-6">
        <p><strong>ID de Pago:</strong> {{ $payment_id }}</p>
        <p><strong>Estado:</strong> {{ $status }}</p>
        <p><strong>Método de Pago:</strong> {{ $payment_type }}</p>
        <div class="mt-4">
            <a href="{{ route('home') }}" class="bg-green-500 text-white px-4 py-2 rounded">Volver al Inicio</a>
        </div>
    </div>
</div>
@endsection
