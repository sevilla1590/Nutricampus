<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:25',
            'apellido' => 'required|string|max:25',
            'direccion' => 'nullable|string|max:50',
            'preferencias' => 'nullable|string|max:100',
            'observaciones' => 'nullable|string|max:100',
        ]);

        Cliente::create($data);

        return redirect()->route('clientes.index')->with('success', 'Cliente created successfully');
    }

    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:25',
            'apellido' => 'required|string|max:25',
            'direccion' => 'nullable|string|max:50',
            'preferencias' => 'nullable|string|max:100',
            'observaciones' => 'nullable|string|max:100',
        ]);

        $cliente->update($data);

        return redirect()->route('clientes.index')->with('success', 'Cliente updated successfully');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente deleted successfully');
    }
}
