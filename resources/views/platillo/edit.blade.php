@extends('layouts.layout')

@section('contenido')
    <h1>Editar Platillo</h1>
    <form action="{{ route('platillo.update', $producto->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Nombre:</label>
        <input type="text" name="nombre" value="{{ $producto->nombre }}" required>
        
        <label>Precio:</label>
        <input type="number" step="0.01" name="precio" value="{{ $producto->precio }}" required>
        
        <label>Descripción:</label>
        <textarea name="descripcion">{{ $producto->descripcion }}</textarea>
        
        <label>Beneficios:</label>
        <textarea name="beneficios">{{ $producto->beneficios }}</textarea>
        
        <label>Disponibilidad:</label>
        <input type="number" name="disponibilidad" value="{{ $producto->disponibilidad }}" required>
        
        <button type="submit">Actualizar</button>
    </form>
@endsection
