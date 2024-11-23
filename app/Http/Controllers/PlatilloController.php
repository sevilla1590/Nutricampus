<?php

namespace App\Http\Controllers;

use App\Models\Producto; // Modelo Producto
use Illuminate\Http\Request;

class PlatilloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $productos = Producto::all(); // Obtiene todos los productos
    dd($productos); // Muestra los datos y detiene la ejecución
    return view('platillo.index', compact('productos'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('platillo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'precio' => 'required|numeric',
            'descripcion' => 'nullable|max:255',
            'beneficios' => 'nullable|max:255',
            'disponibilidad' => 'required|integer|min:0',
        ]);

        Producto::create($request->all());
        return redirect()->route('platillo.index')->with('success', 'Platillo creado exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('platillo.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'precio' => 'required|numeric',
            'descripcion' => 'nullable|max:255',
            'beneficios' => 'nullable|max:255',
            'disponibilidad' => 'required|integer|min:0',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update($request->all());
        return redirect()->route('platillo.index')->with('success', 'Platillo actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Producto::findOrFail($id)->delete();
        return redirect()->route('platillo.index')->with('success', 'Platillo eliminado exitosamente.');
    }
}
