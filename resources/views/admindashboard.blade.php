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
        </div>
        
        <!-- Más secciones según sea necesario -->
    </div>
</div>
@endsection
