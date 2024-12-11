@extends('layouts.admin')

@section('content')
    <div class="container mx-auto my-8 px-4">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Lista de Reembolsos</h1>
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

        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Cliente</th>
                    <td class="border border-gray-300 px-4 py-2"><strong>Número de transacción</strong></td>
                    <th class="border border-gray-300 px-4 py-2">Estado</th>
                    <th class="border border-gray-300 px-4 py-2">Motivo</th> <!-- Nueva columna -->
                    <th class="border border-gray-300 px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reembolsos as $reembolso)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $reembolso->cliente->nombre ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $reembolso->pedido->nro_transaccion ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $reembolso->estado }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $reembolso->motivo }}</td> <!-- Mostrar motivo -->
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="{{ route('reembolsos.edit', $reembolso->id_reembolso) }}"
                                class="text-blue-500 hover:underline">Editar</a>
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
