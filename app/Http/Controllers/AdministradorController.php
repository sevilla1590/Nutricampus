<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    public function index()
    {
        $administradores = Administrador::all();

        return view('administradores.index', compact('administradores'));
    }

    public function create()
    {
        return view('administradores.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:25',
            'apellido' => 'required|string|max:25',
            'horario' => 'required|string|max:20',
        ]);

        Administrador::create($data);

        return redirect()->route('administradores.index')->with('success', 'Administrador created successfully');
    }

    public function show(Administrador $administrador)
    {
        return view('administradores.show', compact('administrador'));
    }

    public function edit(Administrador $administrador)
    {
        return view('administradores.edit', compact('administrador'));
    }

    public function update(Request $request, Administrador $administrador)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:25',
            'apellido' => 'required|string|max:25',
            'horario' => 'required|string|max:20',
        ]);

        $administrador->update($data);

        return redirect()->route('administradores.index')->with('success', 'Administrador updated successfully');
    }

    public function destroy(Administrador $administrador)
    {
        $administrador->delete();

        return redirect()->route('administradores.index')->with('success', 'Administrador deleted successfully');
    }
}
