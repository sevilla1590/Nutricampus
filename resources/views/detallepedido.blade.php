@extends('layouts.layout')

@section('content')
<div class="container mx-auto my-8 px-4">
    <!-- Breadcrumb -->
    <div class="text-sm text-gray-500 mb-4">
        <a href="{{ route('home') }}" class="hover:underline">Home</a> 
        <span> / </span>
        <span class="text-gray-700">{{ $producto->nombre }}</span>
    </div>

    <!-- Product Detail -->
    <div class="flex flex-col md:flex-row items-start bg-white shadow-lg rounded-lg p-6">
        <!-- Image Section -->
        <div class="flex-shrink-0 mb-4 md:mb-0 md:mr-8">
            <img src="{{ asset($producto->imagen ?? 'images/default.png') }}" alt="{{ $producto->nombre }}" class="w-80 h-auto rounded-lg border border-blue-200">
        </div>

        <!-- Details Section -->
        <div class="flex-1">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">{{ $producto->nombre }}</h1>
            
            <!-- Ingredients -->
            <h2 class="text-lg font-semibold text-gray-800">Ingredientes:</h2>
            <ul class="list-disc list-inside text-gray-600 mb-4">
                @foreach(explode("\n", $producto->descripcion) as $ingrediente)
                    <li>{{ $ingrediente }}</li>
                @endforeach
            </ul>
            
            <!-- Nutritional Benefits -->
            <h2 class="text-lg font-semibold text-gray-800">Beneficios nutricionales:</h2>
            <p class="text-gray-600 mb-4">
                {{ $producto->beneficios }}
            </p>
            
            <!-- Divider Line -->
            <hr class="border-t border-gray-300 mb-4">

            <!-- Price and Add to Cart -->
            <div class="flex items-center">
    <span class="text-2xl font-bold text-green-600 mr-6">S/ {{ number_format($producto->precio, 2) }}</span>
    
    @if(auth()->check())
        <!-- Mostrar botón de añadir al carrito si está autenticado -->
        <form action="{{ route('carrito.agregar') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $producto->id }}">
            <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold py-2 px-4 rounded-lg focus:outline-none">
                Añadir al carrito
            </button>
        </form>
    @else
        <!-- Redirigir al login si no está autenticado -->
        <a href="{{ route('login') }}" class="bg-red-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-red-600">
            Inicia sesión para añadir al carrito
        </a>
    @endif
</div>

@endsection
