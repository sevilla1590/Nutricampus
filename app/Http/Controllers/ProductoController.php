<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('producto.index', compact('productos'));
    }

    public function create()
    {
        return view('producto.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100',
            'precio' => 'required|numeric',
            'descripcion' => 'nullable|string|max:100',
            'disponibilidad' => 'required|integer',
        ]);

        Producto::create($data);

        return redirect()->route('producto.index')->with('success', 'Producto created successfully');
    }

    public function show(Producto $producto)
    {
        return view('producto.show', compact('producto'));
    }

    public function edit(Producto $producto)
    {
        return view('producto.edit', compact('producto'));
    }

    public function update(Request $request, Producto $producto)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100',
            'precio' => 'required|numeric',
            'descripcion' => 'nullable|string|max:100',
            'disponibilidad' => 'required|integer',
        ]);

        $producto->update($data);

        return redirect()->route('producto.index')->with('success', 'Producto updated successfully');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('producto.index')->with('success', 'Producto deleted successfully');
    }
}
