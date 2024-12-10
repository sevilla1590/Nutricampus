<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Reembolso;
use Illuminate\Http\Request;

class ReembolsoController extends Controller
{
    //public function index()
    //{
    //    $reembolsos = Reembolso::all();
    //    return view('reembolso.index', compact('reembolsos'));
    //}

    public function index()
    {
        $query = Reembolso::with(['cliente']);

        $reembolsos = $query->get();

        return view('reembolso.index', compact('reembolsos'));
    }

    //public function create()
    //{
    //    return view('cliente.create-reembolso');
    //}

    // Mostrar el formulario para crear un reembolso
    public function create($pedidoId)
    {
        // Obtener el pedido con sus detalles
        //$pedido = Pedido::with('detalles.producto')->findOrFail($pedidoId);

        $pedido = Pedido::findOrFail($pedidoId);

        return view('cliente.create-reembolso', compact('pedido'));
    }

    public function store(Request $request)
    {
        // Verificar si el usuario está autenticado
        if (! auth()->check()) {
            return redirect()->route('login')->with('error', 'Por favor, inicia sesión para crear un reembolso.');
        }

        // Obtener el pedido relacionado
        $pedido = Pedido::find($request->id_pedido); // Recupera el pedido por su ID

        if (! $pedido) {
            return redirect()->back()->with('error', 'El pedido no existe o no es válido.');
        }

        // Crear el reembolso
        $reembolso = Reembolso::create([
            'id_cliente' => auth()->user()->id, // Asegúrate de tener un usuario autenticado
            'id_pedido' => $request->id_pedido,
            'fecha_reembolso' => now(),
            'monto' => $request->monto,
            'motivo' => $request->motivo,
        ]);

        // Redirigir a una página de éxito o de detalles del reembolso
        return redirect()->route('mis.pedidos', ['pedidoId' => $pedido->id]) // Enlace a la ruta de los pedidos
            ->with('success', 'Reembolso creado exitosamente.');
    }

    //public function store(Request $request)
    //{
    //    $data = $request->validate([
    //        'id_cliente' => 'required|exists:cliente,id',
    //        'id_pedido' => 'required|exists:pedido,id',
    //        'fecha_reembolso' => 'required|date',
    //        'monto' => 'required|numeric',
    //       'motivo' => 'nullable|string|max:100',
    //        'estado' => 'nullable|string|max:15',
    //    ]);

    //    Reembolso::create($data);

    //    return redirect()->route('pedidos.index')->with('success', 'Reembolso created successfully');
    //}

    //public function show(Reembolso $reembolso)
    //{
    //    $pedido = Pedido::findOrFail($id);
    //    return view('reembolso.show', compact('reembolso'));
    //}

    public function show($pedidoId)
    {
        // Buscar el pedido
        $pedido = Pedido::findOrFail($pedidoId);

        // Buscar el reembolso asociado al pedido
        $reembolso = Reembolso::where('id_pedido', $pedido->id)->first();

        if ($reembolso) {
            // Si existe un reembolso, mostrarlo
            return view('cliente.estadoReembolso', compact('reembolso', 'pedido'));
        } else {
            // Si no existe reembolso, redirigir o mostrar mensaje
            return redirect()->route('mis.pedidos', ['pedidoId' => $pedido->id])
                ->with('error', 'No se ha realizado un reembolso para este pedido.');
        }
    }

    public function edit(Reembolso $reembolso)
    {
        return view('reembolso.edit', compact('reembolso'));
    }

    public function update(Request $request, Reembolso $reembolso)
    {
        // Validar los datos enviados
        $request->validate([
            'estado' => 'required|in:enviado,aprobado,rechazado',  // El estado debe ser uno de estos
            'respuesta' => 'nullable|string', // La respuesta puede ser nula
        ]);

        // Actualizar el modelo con los datos enviados
        $reembolso->update([
            'estado' => $request->estado,  // Actualizamos el estado
            'respuesta' => $request->respuesta,  // Actualizamos la respuesta (puede ser nula)
        ]);

        // Redirigir a la lista de reembolsos con un mensaje de éxito
        return redirect()->route('reembolsos.index')->with('success', 'Reembolso actualizado correctamente.');
    }

    public function destroy(Reembolso $reembolso)
    {
        $reembolso->delete();

        return redirect()->route('reembolso.index')->with('success', 'Reembolso deleted successfully');
    }
}
