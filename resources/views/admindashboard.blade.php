@extends('layouts.admin')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="container mx-auto px-4 max-w-7xl">
            <!-- Encabezado con estadísticas -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-gray-900 tracking-tight mb-4">Panel de Administración</h1>
                <div class="grid grid-cols-4 gap-4">
                    <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
                        <div class="text-sm text-gray-500">Pedidos Hoy</div>
                        <div class="text-2xl font-semibold text-gray-900">24</div>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
                        <div class="text-sm text-gray-500">Ingresos</div>
                        <div class="text-2xl font-semibold text-gray-900">S/ 1,254</div>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
                        <div class="text-sm text-gray-500">Usuarios Nuevos</div>
                        <div class="text-2xl font-semibold text-gray-900">12</div>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
                        <div class="text-sm text-gray-500">Platillos Activos</div>
                        <div class="text-2xl font-semibold text-gray-900">28</div>
                    </div>
                </div>
            </div>

            <!-- Grid de módulos -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Reportes de Gestión -->
                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-gray-900">Reportes de Gestión</h2>
                            <span
                                class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Nuevo</span>
                        </div>
                        <div class="flex justify-center mb-6">
                            <img src="{{ asset('images/reportes.png') }}" alt="Reportes" class="w-24 h-24 object-contain">
                        </div>
                        <p class="text-sm text-gray-500 mb-4">Visualiza estadísticas y métricas importantes del negocio.</p>
                        <a href="#"
                            class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800">
                            Ver reportes
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Gestionar Reembolsos -->
                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-gray-900">Reembolsos</h2>
                            <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">2
                                pendientes</span>
                        </div>
                        <div class="flex justify-center mb-6">
                            <img src="{{ asset('images/reembolso.png') }}" alt="Reembolsos"
                                class="w-24 h-24 object-contain">
                        </div>
                        <p class="text-sm text-gray-500 mb-4">Gestiona las solicitudes de reembolso de los clientes.</p>
                        <a href="{{ route('reembolsos.index') }}"
                            class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800">
                            Ver reembolsos
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Gestión de Pedidos -->
                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-gray-900">Pedidos</h2>
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">5
                                nuevos</span>
                        </div>
                        <div class="flex justify-center mb-6">
                            <img src="{{ asset('images/pedidos.png') }}" alt="Pedidos" class="w-24 h-24 object-contain">
                        </div>
                        <p class="text-sm text-gray-500 mb-4">Administra y da seguimiento a los pedidos activos.</p>
                        <a href="{{ route('pedidos.listar') }}"
                            class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800">
                            Ver pedidos
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Gestión de Usuarios -->
                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-gray-900">Usuarios</h2>
                            <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded-full">124
                                activos</span>
                        </div>
                        <div class="flex justify-center mb-6">
                            <img src="{{ asset('images/usuarios.png') }}" alt="Usuarios" class="w-24 h-24 object-contain">
                        </div>
                        <p class="text-sm text-gray-500 mb-4">Administra las cuentas y permisos de usuarios.</p>
                        <a href="#"
                            class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800">
                            Gestionar usuarios
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Gestionar Menú -->
                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-gray-900">Menú</h2>
                            <span class="bg-indigo-100 text-indigo-800 text-xs font-medium px-2.5 py-0.5 rounded-full">15
                                platos</span>
                        </div>
                        <div class="flex justify-center mb-6">
                            <img src="{{ asset('images/menu.png') }}" alt="Menú" class="w-24 h-24 object-contain">
                        </div>
                        <p class="text-sm text-gray-500 mb-4">Actualiza y gestiona el menú del restaurante.</p>
                        <a href="{{ route('productos.gestionarMenu') }}"
                            class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800">
                            Gestionar menú
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Gestionar Platillos -->
                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-gray-900">Platillos</h2>
                            <span class="bg-pink-100 text-pink-800 text-xs font-medium px-2.5 py-0.5 rounded-full">28
                                activos</span>
                        </div>
                        <div class="flex justify-center mb-6">
                            <img src="{{ asset('images/platillos.png') }}" alt="Platillos"
                                class="w-24 h-24 object-contain">
                        </div>
                        <p class="text-sm text-gray-500 mb-4">Administra el catálogo de platillos disponibles.</p>
                        <a href="{{ route('productos.gestionarPlatillos') }}"
                            class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800">
                            Ver platillos
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .hover\:shadow-md:hover {
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            }
        </style>
    @endpush
@endsection
