@extends('layouts.admin')

@section('content')
    <div class="container mx-auto my-8 px-4">
        <h1 class="text-2xl font-bold mb-4">Editar Platillo</h1>

        <form action="{{ route('productos.actualizarPlatillo', $producto->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Usamos PUT para actualizar el recurso -->
            
            <div class="mb-4">
                <label for="nombre" class="block text-gray-700">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="w-full border-gray-300 rounded p-2" value="{{ old('nombre', $producto->nombre) }}" required>
            </div>

            <div class="mb-4">
                <label for="descripcion" class="block text-gray-700">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="w-full border-gray-300 rounded p-2">{{ old('descripcion', $producto->descripcion) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="precio" class="block text-gray-700">Precio</label>
                <input type="number" name="precio" id="precio" class="w-full border-gray-300 rounded p-2" value="{{ old('precio', $producto->precio) }}" required step="0.01">
            </div>

            <div class="mb-4">
                <label for="disponibilidad" class="block text-gray-700">Disponibilidad</label>
                <input type="number" name="disponibilidad" id="disponibilidad" class="w-full border-gray-300 rounded p-2" value="{{ old('disponibilidad', $producto->disponibilidad) }}" required>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Guardar Cambios
            </button>
        </form>
    </div>
@endsection
