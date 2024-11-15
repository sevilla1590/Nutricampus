<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::all();
        return view('pedido.index', compact('pedidos'));
    }

    public function create()
    {
        return view('pedido.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_metodo_pago' => 'required|exists:metodo_pago,id',
            'id_cliente' => 'required|exists:cliente,id',
            'id_administrador' => 'nullable|exists:administrador,id',
            'id_repartidor' => 'nullable|exists:repartidor,id',
            'id_cocinero' => 'nullable|exists:cocinero,id',
            'fecha' => 'required|date',
            'total' => 'required|numeric',
            'estado_pago' => 'required|string|max:25',
            'estado' => 'required|string|max:25',
        ]);

        Pedido::create($data);

        return redirect()->route('pedido.index')->with('success', 'Pedido created successfully');
    }

    public function show(Pedido $pedido)
    {
        return view('pedido.show', compact('pedido'));
    }

    public function edit(Pedido $pedido)
    {
        return view('pedido.edit', compact('pedido'));
    }

    public function update(Request $request, Pedido $pedido)
    {
        $data = $request->validate([
            'id_metodo_pago' => 'required|exists:metodo_pago,id',
            'id_cliente' => 'required|exists:cliente,id',
            'id_administrador' => 'nullable|exists:administrador,id',
            'id_repartidor' => 'nullable|exists:repartidor,id',
            'id_cocinero' => 'nullable|exists:cocinero,id',
            'fecha' => 'required|date',
            'total' => 'required|numeric',
            'estado_pago' => 'required|string|max:25',
            'estado' => 'required|string|max:25',
        ]);

        $pedido->update($data);

        return redirect()->route('pedido.index')->with('success', 'Pedido updated successfully');
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->delete();
        return redirect()->route('pedido.index')->with('success', 'Pedido deleted successfully');
    }
}
