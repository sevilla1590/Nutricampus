@extends('layouts.layout')

@section('contenido')
    <h1>Agregar Platillo</h1>
    <form action="{{ route('platillo.store') }}" method="POST">
        @csrf
        <label>Nombre:</label>
        <input type="text" name="nombre" required>
        
        <label>Precio:</label>
        <input type="number" step="0.01" name="precio" required>
        
        <label>Descripción:</label>
        <textarea name="descripcion"></textarea>

        <label>Beneficios:</label>
        <textarea name="Beneficios"></textarea>
        
        <label>Disponibilidad:</label>
        <input type="number" name="disponibilidad" required>
        
        <button type="submit">Guardar</button>
    </form>
@endsection
