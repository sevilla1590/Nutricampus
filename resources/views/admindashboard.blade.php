@extends('layouts.admin')

@section('content')
    <div class="container mx-auto my-8 px-4">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Panel de Administración</h1>

        <div class="grid grid-cols-2 gap-6">
            <!-- Reportes de Gestión -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="font-semibold text-xl text-gray-700 mb-4">Reportes de Gestión</h2>
                <img src="{{ asset('images/reportes.png') }}" alt="Reportes" class="w-32 h-32 mx-auto mb-4">
            </div>

            <!-- Gestionar Reembolsos -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="font-semibold text-xl text-gray-700 mb-4">Gestionar Reembolsos</h2>
                <img src="{{ asset('images/reembolso.png') }}" alt="Reembolsos" class="w-32 h-32 mx-auto mb-4">
                <a href="{{ route('reembolsos.index') }}" class="text-blue-500 hover:underline">Ver Reembolsos</a>
            </div>

            <!-- Gestión de Pedidos -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="font-semibold text-xl text-gray-700 mb-4">Gestión de Pedidos</h2>
                <img src="{{ asset('images/pedidos.png') }}" alt="Pedidos" class="w-32 h-32 mx-auto mb-4">
                <a href="{{ route('pedidos.listar') }}" class="text-blue-500 hover:underline">Ver Pedidos</a>
            </div>

            <!-- Gestión de Usuarios -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="font-semibold text-xl text-gray-700 mb-4">Gestión de Usuarios</h2>
                <img src="{{ asset('images/usuarios.png') }}" alt="Usuarios" class="w-32 h-32 mx-auto">
            </div>

            <!-- Gestionar Menú -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="font-semibold text-xl text-gray-700 mb-4">Gestionar Menú</h2>
                <img src="{{ asset('images/menu.png') }}" alt="Gestionar Menú" class="w-32 h-32 mx-auto mb-4">
                <a href="{{ route('productos.gestionarMenu') }}" class="text-blue-500 hover:underline">Ver Gestionar
                    Menú</a>
            </div>

            <!-- Gestionar Platillos -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="font-semibold text-xl text-gray-700 mb-4">Gestionar Platillos</h2>
                <img src="{{ asset('images/platillos.png') }}" alt="Gestionar Platillos" class="w-32 h-32 mx-auto mb-4">
                <a href="{{ route('productos.gestionarPlatillos') }}" class="text-blue-500 hover:underline">Ver
                    Platillos</a>
            </div>
        </div>
    </div>
@endsection