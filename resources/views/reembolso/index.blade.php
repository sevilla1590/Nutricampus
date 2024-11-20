@extends('layouts.layout')

@section('content')
    <div class="container mx-auto my-8 px-4">
        <h1 class="text-2xl font-bold mb-4">Lista de Reembolsos</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">ID</th>
                    <th class="border border-gray-300 px-4 py-2">Estado</th>
                    <th class="border border-gray-300 px-4 py-2">Motivo</th> <!-- Nueva columna -->
                    <th class="border border-gray-300 px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reembolsos as $reembolso)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $reembolso->id_reembolso }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $reembolso->estado }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $reembolso->motivo }}</td> <!-- Mostrar motivo -->
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="{{ route('reembolsos.edit', $reembolso->id_reembolso) }}" class="text-blue-500 hover:underline">Editar</a>
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
