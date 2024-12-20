<?php

namespace App\Http\Controllers;

use App\Mail\PedidoEntregadoMail;
use App\Models\Cliente;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PedidoController extends Controller
{
    public function listarPedidos(Request $request)
    {
        $query = Pedido::with(['cliente'])->orderBy('created_at', 'desc') ;

        if ($request->filled('estado')) {
            $query->where('estado', $request->input('estado'));
        }

        $pedidos = $query->paginate(5);

        return view('pedido.index', compact('pedidos')); // Pasa los datos a la vista
    }

    public function verEstado($id)
    {
        // Buscar el pedido por ID
        $pedido = Pedido::find($id);

        // Validar que el pedido exista
        if (! $pedido) {
            return redirect()->route('mis.pedidos')->with('error', 'El pedido no existe.');
        }

        // Pasar el pedido a la vista
        return view('cliente.estado', compact('pedido'));
    }

    public function misPedidos()
    {
        $user = Auth::user(); // Usuario autenticado

        // Verificar si el usuario tiene un cliente asociado
        $cliente = Cliente::where('id', $user->id)->first();

        if (! $cliente) {
            abort(403, 'No tienes un perfil de cliente asociado.');
        }

        // Obtener los pedidos del cliente autenticado
        $pedidos = Pedido::where('id_cliente', $cliente->id_cliente)
            ->with('metodoPago') // Relación con la tabla de métodos de pago
            ->orderBy('created_at', 'desc') // Ordenar por fecha de creación, del más reciente al más antiguo
            ->paginate(3); // Paginación de 5 elementos por página

        // Pasar los pedidos a la vista
        return view('cliente.mis-pedidos', compact('pedidos'));
    }

    public function verDetallePedido($id)
    {
        $user = Auth::user(); // Usuario autenticado

        // Buscar el cliente asociado al usuario autenticado
        $cliente = Cliente::where('id', $user->id)->first();

        if (! $cliente) {
            abort(403, 'No tienes un perfil de cliente asociado.');
        }

        // Buscar el pedido por ID
        $pedido = Pedido::with(['metodoPago', 'detalles.producto']) // Cargar relaciones
            ->where('id', $id)
            ->first();

        if (! $pedido) {
            abort(404, 'Pedido no encontrado.');
        }

        // Verificar si el pedido pertenece al cliente autenticado
        if ($pedido->id_cliente != $cliente->id_cliente) {
            abort(403, 'No tienes permiso para ver este pedido.');
        }

        // Pasar el pedido a la vista
        return view('cliente.detalle-pedido', compact('pedido'));
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

        // Verificar si el estado cambia a "entregado"
        $estadoAnterior = $pedido->estado;
        $pedido->estado = $request->estado;
        $pedido->save();

        // Enviar correo si el estado cambia a "entregado"
        if ($estadoAnterior !== 'entregado' && $pedido->estado === 'entregado') {
            // Acceder al correo del usuario a través de las relaciones
            $correo = $pedido->cliente->user->email ?? null;

            if (! empty($correo)) {
                Mail::to($correo)->send(new PedidoEntregadoMail($pedido));
            } else {
                return redirect()->route('pedidos.listar')->with('error', 'El cliente no tiene un correo electrónico válido.');
            }
        }

        // Redirigir con mensaje de éxito
        return redirect()->route('pedidos.listar')->with('success', 'El estado del pedido ha sido actualizado correctamente.');
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->delete();

        return redirect()->route('pedido.index')->with('success', 'Pedido deleted successfully');
    }
}
