<?php

namespace App\Http\Controllers;

use App\Models\Repartidor;
use Illuminate\Http\Request;

class RepartidorController extends Controller
{
    public function index()
    {
        $repartidores = Repartidor::all();
        return view('repartidor.index', compact('repartidores'));
    }

    public function create()
    {
        return view('repartidor.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:25',
            'apellido' => 'required|string|max:25',
            'horario' => 'nullable|string|max:20',
            'placa_vehiculo' => 'nullable|string|max:10',
            'numero_licencia' => 'nullable|string|max:20',
            'certificado' => 'nullable|string|max:50',
        ]);

        Repartidor::create($data);

        return redirect()->route('repartidor.index')->with('success', 'Repartidor created successfully');
    }

    public function show(Repartidor $repartidor)
    {
        return view('repartidor.show', compact('repartidor'));
    }

    public function edit(Repartidor $repartidor)
    {
        return view('repartidor.edit', compact('repartidor'));
    }

    public function update(Request $request, Repartidor $repartidor)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:25',
            'apellido' => 'required|string|max:25',
            'horario' => 'nullable|string|max:20',
            'placa_vehiculo' => 'nullable|string|max:10',
            'numero_licencia' => 'nullable|string|max:20',
            'certificado' => 'nullable|string|max:50',
        ]);

        $repartidor->update($data);

        return redirect()->route('repartidor.index')->with('success', 'Repartidor updated successfully');
    }

    public function destroy(Repartidor $repartidor)
    {
        $repartidor->delete();
        return redirect()->route('repartidor.index')->with('success', 'Repartidor deleted successfully');
    }
}
