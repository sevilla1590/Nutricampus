@extends('layouts.layout')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Crear Reembolso</h2>

        <form action="{{ route('reembolsos.store') }}" method="POST">
            @csrf

            <!-- Pedido Seleccionado -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Pedido</label>
                <input type="text" name="pedido" value="Pedido #{{ $pedido->id }}"
                    class="block w-full mt-2 border-gray-300 rounded-md" disabled>
                <input type="hidden" name="id_pedido" value="{{ $pedido->id }}">
            </div>

            <!-- Motivo -->
            <div class="mb-4">
                <label for="motivo" class="block text-sm font-medium text-gray-700">Motivo del Reembolso</label>
                <textarea id="motivo" name="motivo" rows="3" class="block w-full mt-2 border-gray-300 rounded-md" required>{{ old('motivo') }}</textarea>
                @error('motivo')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Monto -->
            <div class="mb-4">
                <label for="monto" class="block text-sm font-medium text-gray-700">Monto a Reembolsar</label>
                <input type="number" name="monto" step="0.01" class="block w-full mt-2 border-gray-300 rounded-md"
                    value="{{ old('monto') }}" required>
                @error('monto')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Productos del Pedido -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Selecciona el Producto para Reembolso</label>
                <ul class="divide-y">
                    @foreach ($pedido->detalles as $detalle)
                        <li class="py-2 flex justify-between items-center">
                            <span>{{ $detalle->producto->nombre }} - S/ {{ number_format($detalle->subtotal, 2) }}</span>
                            <input type="checkbox" name="productos[]" value="{{ $detalle->id }}">
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Submit Button -->
            <div class="mt-4">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Pedir Reembolso</button>
            </div>
        </form>
    </div>
@endsection
