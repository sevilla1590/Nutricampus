@extends('layouts.layout')

@section('content')
<div class="container mx-auto my-8 px-4">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Gestionar Menú</h1>

    <!-- Formulario para crear/editar productos -->
    <div class="bg-white shadow-md rounded p-4 mb-6">
        <h2 class="text-lg font-semibold mb-4" id="form-title">Crear Producto</h2>
        <form id="producto-form" action="{{ route('productos.crearProducto') }}" method="POST">
    @csrf
    <input type="hidden" name="id" id="producto-id" value="">

    <!-- Campo para emular PUT en caso de edición -->
    @if(isset($producto))
        <input type="hidden" name="_method" value="PUT">
    @endif

    <!-- Campo Nombre -->
    <div class="mb-4">
        <label class="block text-gray-700">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="w-full border-gray-300 rounded p-2 focus:ring focus:ring-blue-200" required>
    </div>

    <!-- Campo Precio -->
    <div class="mb-4">
        <label class="block text-gray-700">Precio</label>
        <input type="number" name="precio" id="precio" step="0.01" class="w-full border-gray-300 rounded p-2 focus:ring focus:ring-blue-200" required>
    </div>

    <!-- Campo Descripción -->
    <div class="mb-4">
        <label class="block text-gray-700">Descripción</label>
        <textarea name="descripcion" id="descripcion" class="w-full border-gray-300 rounded p-2 focus:ring focus:ring-blue-200"></textarea>
    </div>

    <!-- Campo Disponibilidad -->
    <div class="mb-4">
        <label class="block text-gray-700">Disponibilidad</label>
        <input type="number" name="disponibilidad" id="disponibilidad" class="w-full border-gray-300 rounded p-2 focus:ring focus:ring-blue-200" required>
    </div>

    <!-- Botones -->
    <div class="flex space-x-4">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded" id="btn-crear">Crear Producto</button>
        <button type="button" class="bg-green-500 text-white px-4 py-2 rounded hidden" id="btn-actualizar">Actualizar Producto</button>
    </div>
</form>

    </div>
    
    <!-- Gestionar productos en la carta -->
    <div class="bg-white shadow-md rounded p-4">
        <h2 class="text-lg font-semibold mb-4">Seleccionar Productos para la Carta</h2>
        <form action="{{ route('productos.actualizarCarta') }}" method="POST">
            @csrf
            <div class="grid grid-cols-3 gap-4">
                @foreach ($productos as $producto)
                    <label class="flex items-center cursor-pointer producto-item"
                        data-id="{{ $producto->id }}"
                        data-nombre="{{ $producto->nombre }}"
                        data-precio="{{ $producto->precio }}"
                        data-descripcion="{{ $producto->descripcion }}"
                        data-disponibilidad="{{ $producto->disponibilidad }}">
                        <input type="checkbox" name="productos[]" value="{{ $producto->id }}"
                            {{ $menu->contains($producto) ? 'checked' : '' }}
                            class="mr-2">
                        {{ $producto->nombre }} (S/ {{ number_format($producto->precio, 2) }})
                    </label>
                @endforeach
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-4 rounded">Actualizar Carta</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
    const productoForm = document.getElementById('producto-form');
    const productoIdField = document.getElementById('producto-id');
    const nombreField = document.getElementById('nombre');
    const precioField = document.getElementById('precio');
    const descripcionField = document.getElementById('descripcion');
    const disponibilidadField = document.getElementById('disponibilidad');
    const btnCrear = document.getElementById('btn-crear');
    const btnActualizar = document.getElementById('btn-actualizar');

    // Manejar clic en productos de la lista
    document.querySelectorAll('.producto-item').forEach(item => {
        item.addEventListener('click', function () {
            // Rellenar el formulario con los datos del producto seleccionado
            productoIdField.value = this.dataset.id;
            nombreField.value = this.dataset.nombre;
            precioField.value = this.dataset.precio;
            descripcionField.value = this.dataset.descripcion;
            disponibilidadField.value = this.dataset.disponibilidad;

            // Cambiar el formulario al modo "Actualizar"
            productoForm.action = "{{ route('productos.editarProducto', ':id') }}".replace(':id', this.dataset.id);
            productoForm.method = 'POST'; // Laravel interpreta POST con _method=PUT como PUT

            // Mostrar el botón Actualizar y ocultar Crear
            btnCrear.classList.add('hidden');
            btnActualizar.classList.remove('hidden');
        });
    });

    // Al cancelar la edición
    btnActualizar.addEventListener('click', function () {
        // Restablecer el formulario
        productoForm.reset();
        productoForm.action = "{{ route('productos.crearProducto') }}";
        productoForm.method = 'POST'; // Volver a modo creación
        productoIdField.value = '';

        // Mostrar el botón Crear y ocultar Actualizar
        btnCrear.classList.remove('hidden');
        btnActualizar.classList.add('hidden');
    });
});

    </script>

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
