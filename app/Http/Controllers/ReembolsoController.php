<?php

namespace App\Http\Controllers;

use App\Models\Reembolso;
use Illuminate\Http\Request;

class ReembolsoController extends Controller
{
    public function index()
    {
        $reembolsos = Reembolso::all();
        return view('reembolso.index', compact('reembolsos'));
    }

    public function create()
    {
        return view('reembolso.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_cliente' => 'required|exists:cliente,id',
            'id_pedido' => 'required|exists:pedido,id',
            'fecha_reembolso' => 'required|date',
            'monto' => 'required|numeric',
            'motivo' => 'nullable|string|max:100',
            'estado' => 'nullable|string|max:15',
        ]);

        Reembolso::create($data);

        return redirect()->route('reembolso.index')->with('success', 'Reembolso created successfully');
    }

    public function show(Reembolso $reembolso)
    {
        return view('reembolso.show', compact('reembolso'));
    }

    public function edit(Reembolso $reembolso)
    {
        return view('reembolso.edit', compact('reembolso'));
    }

    public function update(Request $request, Reembolso $reembolso)
    {
        $data = $request->validate([
            'id_cliente' => 'required|exists:cliente,id',
            'id_pedido' => 'required|exists:pedido,id',
            'fecha_reembolso' => 'required|date',
            'monto' => 'required|numeric',
            'motivo' => 'nullable|string|max:100',
            'estado' => 'nullable|string|max:15',
        ]);

        $reembolso->update($data);

        return redirect()->route('reembolso.index')->with('success', 'Reembolso updated successfully');
    }

    public function destroy(Reembolso $reembolso)
    {
        $reembolso->delete();
        return redirect()->route('reembolso.index')->with('success', 'Reembolso deleted successfully');
    }
}
