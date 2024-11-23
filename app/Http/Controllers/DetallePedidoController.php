<?php

namespace App\Http\Controllers;

use App\Models\DetallePedido;
use Illuminate\Http\Request;

class DetallePedidoController extends Controller
{
    public function index()
    {
        $detallePedidos = DetallePedido::all();
        return view('detalle_pedido.index', compact('detallePedidos'));
    }

    public function create()
    {
        return view('detalle_pedido.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_pedido' => 'required|exists:pedido,id',
            'id_producto' => 'required|exists:producto,id',
            'precio_unitario' => 'required|numeric',
            'cantidad' => 'required|integer',
            'subtotal' => 'required|numeric',
        ]);

        DetallePedido::create($data);

        return redirect()->route('detalle-pedido.index')->with('success', 'Detalle de Pedido created successfully');
    }

    public function show(DetallePedido $detallePedido)
    {
        return view('detalle_pedido.show', compact('detallePedido'));
    }

    public function edit(DetallePedido $detallePedido)
    {
        return view('detalle_pedido.edit', compact('detallePedido'));
    }

    public function update(Request $request, DetallePedido $detallePedido)
    {
        $data = $request->validate([
            'id_pedido' => 'required|exists:pedido,id',
            'id_producto' => 'required|exists:producto,id',
            'precio_unitario' => 'required|numeric',
            'cantidad' => 'required|integer',
            'subtotal' => 'required|numeric',
        ]);

        $detallePedido->update($data);

        return redirect()->route('detalle-pedido.index')->with('success', 'Detalle de Pedido updated successfully');
    }

    public function destroy(DetallePedido $detallePedido)
    {
        $detallePedido->delete();
        return redirect()->route('detalle-pedido.index')->with('success', 'Detalle de Pedido deleted successfully');
    }

    //Ver detalle de pedido para administrador
    public function verDetallePedido($id)
    {
        // Obtener el pedido con sus detalles y cliente
        $pedido = Pedido::with(['detalles.producto', 'cliente'])->findOrFail($id);
    
        // Retornar la vista con los datos
        return view('admin.detalle-pedido', compact('pedido'));
    }
    
}

