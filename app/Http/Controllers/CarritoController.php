<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function agregar(Request $request)
    {
        $productoId = $request->input('id');
        $producto = Producto::findOrFail($productoId);

        $carrito = session()->get('carrito', []);

        if (isset($carrito[$productoId])) {
            // Validar que no se exceda la disponibilidad
            if ($carrito[$productoId]['cantidad'] + 1 > $producto->disponibilidad) {
                return redirect()->back()->with('error', "No hay suficiente stock para el producto {$producto->nombre}. Disponible: {$producto->disponibilidad}.");
            }
            $carrito[$productoId]['cantidad']++;
        } else {
            // Validar que haya al menos 1 en stock
            if ($producto->disponibilidad < 1) {
                return redirect()->back()->with('error', "El producto {$producto->nombre} no tiene stock disponible.");
            }
            $carrito[$productoId] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'cantidad' => 1,
                'imagen' => $producto->imagen,
            ];
        }

        session()->put('carrito', $carrito);

        return redirect()->back()->with('message', 'Producto añadido al carrito.');
    }

    public function verCarrito()
    {
        $carrito = session()->get('carrito', []);
        $total = array_reduce($carrito, function ($carry, $item) {
            return $carry + ($item['precio'] * $item['cantidad']);
        }, 0);

        return view('carrito', compact('carrito', 'total'));
    }

    public function actualizar(Request $request, $id)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1|max:20',
        ]);

        $carrito = session()->get('carrito', []);

        if (! isset($carrito[$id])) {
            return response()->json([
                'success' => false,
                'message' => 'Producto no encontrado en el carrito.',
            ]);
        }

        $producto = Producto::find($id);

        if (! $producto) {
            return response()->json([
                'success' => false,
                'message' => 'Producto no encontrado en la base de datos.',
            ]);
        }

        // Validar que la cantidad solicitada no exceda la disponibilidad
        if ($request->cantidad > $producto->disponibilidad) {
            return response()->json([
                'success' => false,
                'message' => "No hay suficiente stock para el producto {$producto->nombre}. Disponible: {$producto->disponibilidad}.",
            ]);
        }

        // Actualizar la cantidad en el carrito
        $carrito[$id]['cantidad'] = $request->cantidad;
        session()->put('carrito', $carrito);

        $subtotal = $carrito[$id]['precio'] * $carrito[$id]['cantidad'];
        $total = array_reduce($carrito, function ($carry, $item) {
            return $carry + ($item['precio'] * $item['cantidad']);
        }, 0);

        return response()->json([
            'success' => true,
            'subtotal' => $subtotal,
            'total' => $total,
            'carrito' => $carrito, // Devolvemos el carrito actualizado al cliente
        ]);
    }

    public function eliminar($id)
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }

        session()->flash('message', 'Producto eliminado del carrito.');

        return redirect()->route('carrito.ver');
    }
}
