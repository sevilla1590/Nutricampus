<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    public function listarPedidos(Request $request)
    {
        $query = Pedido::with(['cliente','producto']);

        if ($request->filled('estado')) {
            $query->where('estado', $request->input('estado'));
        }

        $pedidos = $query->get();
        return view('pedido.index', compact('pedidos')); // Pasa los datos a la vista
    }

    public function misPedidos()
    {
        $cliente = Auth::user(); // Obtener el usuario autenticado
        $pedidos = Pedido::where('id_cliente', $cliente->id)->with('producto')->get(); // Obtener pedidos del cliente

        return view('cliente.mis-pedidos', compact('pedidos')); // Retornar la vista con los pedidos
    }

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
        return view('pedido.show', compact('pedido')); // Pasa el pedido directamente a la vista
    }

    public function edit(Pedido $pedido)
    {
        return view('pedido.edit', compact('pedido'));
    }

    public function update(Request $request, Pedido $pedido)
    {
        // Validar el estado
        $request->validate([
            'estado' => 'required|in:en cola,en preparación,en camino,entregado',
        ]);

        // Actualizar el estado del pedido
        $pedido->estado = $request->estado;
        $pedido->save(); // Guardar los cambios en la base de datos

        // Redirigir a la lista de pedidos con un mensaje de éxito
        return redirect()->route('pedidos.listar')->with('success', 'El estado del pedido ha sido actualizado correctamente.');
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->delete();
        return redirect()->route('pedido.index')->with('success', 'Pedido deleted successfully');
    }
}
