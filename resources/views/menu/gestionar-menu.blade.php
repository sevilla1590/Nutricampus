@extends('layouts.layout')

@section('content')
<div class="container mx-auto my-8 px-4">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Gestionar Menú</h1>

    <!-- Crear nuevo producto -->
    <div class="bg-white shadow-md rounded p-4 mb-6">
        <h2 class="text-lg font-semibold mb-4">Crear Producto</h2>
        <form action="{{ route('productos.crearProducto') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Nombre</label>
                <input type="text" name="nombre" class="w-full border-gray-300 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Precio</label>
                <input type="number" name="precio" step="0.01" class="w-full border-gray-300 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Descripción</label>
                <textarea name="descripcion" class="w-full border-gray-300 rounded"></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Disponibilidad</label>
                <input type="number" name="disponibilidad" class="w-full border-gray-300 rounded" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Crear Producto</button>
        </form>
    </div>

    <!-- Gestionar productos en la carta -->
    <div class="bg-white shadow-md rounded p-4">
        <h2 class="text-lg font-semibold mb-4">Seleccionar Productos para la Carta</h2>
        <form action="{{ route('productos.actualizarCarta') }}" method="POST">
            @csrf
            <div class="grid grid-cols-3 gap-4">
                @foreach ($productos as $producto)
                    <label class="flex items-center">
                        <input type="checkbox" name="productos[]" value="{{ $producto->id }}"
                            {{ $menu->contains($producto) ? 'checked' : '' }}
                            class="mr-2">
                        {{ $producto->nombre }} (S/ {{ $producto->precio }})
                    </label>
                @endforeach
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-4 rounded">Actualizar Carta</button>
        </form>
    </div>

    <!-- Mostrar productos en la carta -->
    <div class="mt-6">
        <h2 class="text-lg font-semibold mb-4">Productos en la Carta</h2>
        <ul class="list-disc pl-5">
            @foreach ($menu as $producto)
                <li>{{ $producto->nombre }} (S/ {{ $producto->precio }})</li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
