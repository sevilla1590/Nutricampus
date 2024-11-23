@extends('layouts.layout')

@section('contenido')
    <h1>Gestión de Platillos</h1>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Descripción</th>
                <th>Beneficios</th>
                <th>Disponibilidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->precio }}</td>
                    <td>{{ $producto->descripcion }}</td>
                    <td>{{ $producto->beneficios }}</td>
                    <td>{{ $producto->disponibilidad }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
