@extends('layouts.layout')

@section('content')
    <div class="container mx-auto my-8 px-4">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Panel de Administración</h1>

        <div class="grid grid-cols-2 gap-8">
            <div class="bg-white shadow-md rounded p-4">
                <h2 class="font-semibold text-lg">Reportes de Gestión</h2>
                <img src="{{ asset('images/reportes.png') }}" alt="Reportes" class="my-4">
            </div>

            <div class="bg-white shadow-md rounded p-4">
                <h2 class="font-semibold text-lg">Gestionar Reembolsos</h2>
                <img src="{{ asset('images/reembolsos.png') }}" alt="Reembolsos" class="my-4">
                <a href="{{ route('reembolsos.index') }}" class="text-blue-500 hover:underline">Ver Reembolsos</a>
            </div>

            <div class="bg-white shadow-md rounded p-4">
                <h2 class="font-semibold text-lg">Gestión de Pedidos</h2>
                <img src="{{ asset('images/pedidos.png') }}" alt="Pedidos" class="my-4">
                <a href="{{ route('pedidos.listar') }}" class="text-blue-500 hover:underline">Ver Pedidos</a>
            </div>

            <div class="bg-white shadow-md rounded p-4">
                <h2 class="font-semibold text-lg">Gestión de Usuarios</h2>
                <img src="{{ asset('images/usuarios.png') }}" alt="Usuarios" class="my-4">
            </div>

            <div class="bg-white shadow-md rounded p-4">
                <h2 class="font-semibold text-lg">Gestionar Menú</h2>
                <img src="{{ asset('images/menu.png') }}" alt="Gestionar Menú" class="my-4">
                <a href="{{ route('productos.gestionarMenu') }}" class="text-blue-500 hover:underline">Ver Gestionar Menú</a>
            </div>

        </div>
    </div>
@endsection
