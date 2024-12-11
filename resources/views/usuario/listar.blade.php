@extends('layouts.admin')

@section('content')
    <div class="container mx-auto my-8 px-4">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Gestión de Usuarios</h1>
            </div>
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center text-gray-600 hover:text-gray-900 transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Volver al Panel
            </a>
        </div>
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">ID</th>
                    <th class="border border-gray-300 px-4 py-2">Email</th>
                    <th class="border border-gray-300 px-4 py-2">Nombre</th>
                    <th class="border border-gray-300 px-4 py-2">Apellido</th>
                    <th class="border border-gray-300 px-4 py-2">Rol Actual</th>
                    <th class="border border-gray-300 px-4 py-2">Estado</th>
                    <th class="border border-gray-300 px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $user)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->id }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->cliente->nombre ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->cliente->apellido ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            @if ($user->id_rol == 2)
                                Cliente
                            @else
                                Administrador
                            @endif
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ $user->cliente->estado ?? 'N/A' }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            @if ($user->id_rol == 2)
                                <!-- Botón para promover a administrador -->
                                <form action="{{ route('usuarios.promocion') }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Promover a Administrador
                                    </button>
                                </form>
                            @endif

                            @if ($user->cliente->estado == 'activo')
                                <!-- Botón para desactivar cliente -->
                                <form action="{{ route('usuarios.desactivar') }}" method="POST" class="inline ml-2">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        Desactivar
                                    </button>
                                </form>
                            @endif
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
