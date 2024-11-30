@extends('layouts.admin')

@section('content')
    <div class="container mx-auto my-8 px-4">
        <h1 class="text-2xl font-bold mb-4">Gestionar Platillos del Menú</h1>

        @if(session('success'))
            <div class="bg-green-500 text-white p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full table-auto">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left">ID</th>
                    <th class="px-4 py-2 text-left">Nombre</th>
                    <th class="px-4 py-2 text-left">Precio</th>
                    <th class="px-4 py-2 text-left">Disponibilidad</th>
                    <th class="px-4 py-2 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                    <tr>
                        <td class="px-4 py-2">{{ $producto->id }}</td>
                        <td class="px-4 py-2">{{ $producto->nombre }}</td>
                        <td class="px-4 py-2">{{ number_format($producto->precio, 2) }}</td>
                        <td class="px-4 py-2">{{ $producto->disponibilidad }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('productos.editarPlatillo', $producto->id) }}" class="text-blue-500 hover:underline">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('admin.dashboard') }}" class="text-blue-500 hover:underline mt-4 block">
            Volver al Panel de Administración
        </a>

    </div>
@endsection
