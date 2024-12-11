@extends('layouts.admin')

@section('content')
    <div class="container mx-auto py-4 sm:py-6 px-2 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <br>
        <br>
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
            <div>
                <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900">Lista de Reembolsos</h1>
                <p class="mt-1 text-xs sm:text-sm text-gray-600">Gestiona las solicitudes de reembolso de los clientes</p>
            </div>
            <a href="{{ route('admin.dashboard') }}"
                class="inline-flex items-center px-3 py-1.5 sm:px-4 sm:py-2 bg-gray-100 hover:bg-gray-200 text-sm text-gray-700 rounded-lg transition-colors duration-200">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Volver
            </a>
        </div>

        <!-- Alert Message -->
        @if (session('success'))
            <div
                class="mb-4 sm:mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-3 sm:p-4 rounded-r shadow-sm">
                <div class="flex items-center">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-sm sm:text-base">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Table Section - Desktop -->
        <div class="hidden sm:block bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Cliente
                            </th>
                            <th scope="col"
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nº Transacción
                            </th>
                            <th scope="col"
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Estado
                            </th>
                            <th scope="col"
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Motivo
                            </th>
                            <th scope="col"
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($reembolsos as $reembolso)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $reembolso->cliente->nombre ?? 'N/A' }}
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $reembolso->pedido->nro_transaccion ?? 'N/A' }}
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full   
                                {{ $reembolso->estado === 'Aprobado'
                                    ? 'bg-green-100 text-green-800'
                                    : ($reembolso->estado === 'Pendiente'
                                        ? 'bg-yellow-100 text-yellow-800'
                                        : 'bg-red-100 text-red-800') }}">
                                        {{ $reembolso->estado }}
                                    </span>
                                </td>
                                <td class="px-4 sm:px-6 py-4 text-sm text-gray-900">
                                    {{ $reembolso->motivo }}
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm">
                                    <a href="{{ route('reembolsos.edit', $reembolso->id_reembolso) }}"
                                        class="inline-flex items-center px-2.5 py-1.5 border border-transparent rounded-md text-xs sm:text-sm font-medium text-blue-600 hover:text-blue-800">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Editar
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Mobile View -->
        <div class="sm:hidden space-y-4">
            @foreach ($reembolsos as $reembolso)
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <h3 class="text-sm font-medium text-gray-900">{{ $reembolso->cliente->nombre ?? 'N/A' }}</h3>
                            <p class="text-xs text-gray-500 mt-1">Nº: {{ $reembolso->pedido->nro_transaccion ?? 'N/A' }}</p>
                        </div>
                        <span
                            class="px-2 py-1 text-xs font-semibold rounded-full   
                    {{ $reembolso->estado === 'Aprobado'
                        ? 'bg-green-100 text-green-800'
                        : ($reembolso->estado === 'Pendiente'
                            ? 'bg-yellow-100 text-yellow-800'
                            : 'bg-red-100 text-red-800') }}">
                            {{ $reembolso->estado }}
                        </span>
                    </div>
                    <div class="mb-3">
                        <p class="text-xs text-gray-600 font-medium">Motivo:</p>
                        <p class="text-sm text-gray-900 mt-1">{{ $reembolso->motivo }}</p>
                    </div>
                    <div class="flex justify-end">
                        <a href="{{ route('reembolsos.edit', $reembolso->id_reembolso) }}"
                            class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-600 rounded-md text-sm font-medium">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Editar
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Footer Navigation -->
        <div class="mt-4 sm:mt-6">
            <a href="{{ route('admin.dashboard') }}"
                class="inline-flex items-center text-xs sm:text-sm font-medium text-gray-500 hover:text-gray-700">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Volver al Panel
            </a>
        </div>
    </div>

    @push('styles')
        <style>
            @media (max-width: 640px) {
                .container {
                    padding-left: 1rem;
                    padding-right: 1rem;
                }
            }

            .table-responsive {
                scrollbar-width: thin;
                scrollbar-color: rgba(156, 163, 175, 0.5) transparent;
            }

            .table-responsive::-webkit-scrollbar {
                width: 6px;
                height: 6px;
            }

            .table-responsive::-webkit-scrollbar-track {
                background: transparent;
            }

            .table-responsive::-webkit-scrollbar-thumb {
                background-color: rgba(156, 163, 175, 0.5);
                border-radius: 3px;
            }
        </style>
    @endpush
@endsection
