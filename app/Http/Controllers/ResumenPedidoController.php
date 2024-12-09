<?php  

namespace App\Http\Controllers;  

use Illuminate\Http\Request;  
use Illuminate\Support\Facades\Auth;  
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Facades\Mail;  
use App\Mail\ConfirmacionPedido;
use App\Models\Pedido;  
use MercadoPago\Client\Preference\PreferenceClient;  
use MercadoPago\MercadoPagoConfig;  

class ResumenPedidoController extends Controller  
{  
    public function mostrarResumen()  
    {  
        $carrito = session()->get('carrito', []);  

        if (empty($carrito)) {  
            return redirect()->route('carrito.ver')->with('error', 'El carrito está vacío.');  
        }  

        // Validar la disponibilidad de los productos  
        foreach ($carrito as $item) {  
            $producto = DB::table('producto')->where('id', $item['id'])->first();  

            if (!$producto) {  
                return redirect()->route('carrito.ver')->with('error', "El producto {$item['nombre']} no existe.");  
            }  

            if ($producto->disponibilidad < $item['cantidad']) {  
                return redirect()->route('carrito.ver')->with('error', "No hay suficiente stock para el producto {$item['nombre']}. Disponible: {$producto->disponibilidad}.");  
            }  
        }  

        $total = array_reduce($carrito, function ($carry, $item) {  
            return $carry + ($item['precio'] * $item['cantidad']);  
        }, 0);  

        MercadoPagoConfig::setAccessToken(env('MERCADOPAGO_ACCESS_TOKEN'));  

        $items = [];  
        foreach ($carrito as $item) {  
            $items[] = [  
                "title" => $item['nombre'],  
                "quantity" => $item['cantidad'],  
                "unit_price" => (float) $item['precio'],  
            ];  
        }  

        $client = new PreferenceClient();  
        try {  
            $preference = $client->create([  
                "items" => $items,  
                "back_urls" => [  
                    "success" => route('pago.exitoso'),  
                    "failure" => route('pago.fallido'),  
                ],  
                "auto_return" => "approved",  
            ]);  

            return view('resumenpedido', compact('carrito', 'total', 'preference'));  
        } catch (\Exception $e) {  
            return redirect()->route('carrito.ver')->with('error', 'Error al procesar el pago: ' . $e->getMessage());  
        }  
    }  

    public function pagoExitoso(Request $request)  
    {  
        $payment_id = $request->query('collection_id');  
        $status = $request->query('collection_status');  
        $payment_type = $request->query('payment_type');  
        $nro_transaccion = $payment_id;  

        // Obtener carrito de la sesión  
        $carrito = session()->get('carrito', []);  
        if (empty($carrito)) {  
            return redirect()->route('carrito.ver')->with('error', 'El carrito está vacío.');  
        }  

        // Obtener el id_cliente basado en el usuario autenticado  
        $id_cliente = DB::table('cliente')->where('id', Auth::user()->id)->value('id_cliente');  
        if (!$id_cliente) {  
            return redirect()->route('index')->with('error', 'No se encontró un cliente válido para procesar el pedido.');  
        }  

        // Mapear el método de pago  
        $metodos_pago = [  
            'credit_card' => 1,  
            'bank_transfer' => 2,  
        ];  
        $id_metodo_pago = $metodos_pago[$payment_type] ?? null;  

        DB::beginTransaction(); // Inicia una transacción para evitar inconsistencias  

        try {  
            // Insertar en la tabla pedido  
            $pedido = Pedido::create([  
                'id_metodo_pago' => $id_metodo_pago,  
                'id_cliente' => $id_cliente,
                'id_administrador' => null,
                'id_repartidor' => null,
                'id_cocinero' => null,
                'fecha' => now(),
                'total' => array_reduce($carrito, fn($carry, $item) => $carry + $item['precio'] * $item['cantidad'], 0),  
                'estado_pago' => $status,  
                'estado' => 'Pendiente',
                'created_at' => now(),  
                'updated_at' => now(),
                'nro_transaccion' => $nro_transaccion,
            ]);  

            // Insertar en la tabla detalle_pedido y actualizar la disponibilidad de los productos  
            foreach ($carrito as $producto) {  
                // Descontar la cantidad comprada del campo disponibilidad  
                $producto_db = DB::table('producto')->where('id', $producto['id'])->first();  

                if (!$producto_db) {  
                    throw new \Exception("El producto con ID {$producto['id']} no existe.");  
                }  

                if ($producto_db->disponibilidad < $producto['cantidad']) {  
                    throw new \Exception("No hay suficiente disponibilidad para el producto: {$producto['nombre']}.");  
                }  

                // Actualizar la disponibilidad del producto  
                DB::table('producto')->where('id', $producto['id'])->update([  
                    'disponibilidad' => $producto_db->disponibilidad - $producto['cantidad'],  
                ]);  

                // Insertar en la tabla detalle_pedido
                $pedido->detalles()->create([  
                    'id_producto' => $producto['id'],  
                    'precio_unitario' => $producto['precio'],  
                    'cantidad' => $producto['cantidad'],  
                    'subtotal' => $producto['precio'] * $producto['cantidad'],
                    'created_at' => now(),
                    'updated_at' => now(),
                    ]);
            }  

            DB::commit(); // Confirmar la transacción  

            // Enviar correo de confirmación  
            $pedido->load('cliente', 'detalles.producto'); // Cargar relaciones necesarias  
            Mail::to(Auth::user()->email)->send(new ConfirmacionPedido($pedido)); 

            // Limpiar carrito  
            session()->forget('carrito');  

            // Renderizar la vista de pago exitoso  
            return view('pagoexitoso', [  
                'payment_id' => $payment_id,  
                'status' => $status === 'approved' ? 'Aprobado' : 'Fallido',  
                'payment_type' => $payment_type === 'credit_card' ? 'Tarjeta de crédito' : 'Otro',  
                'cliente' => Auth::user()->name,  
                'fecha' => now()->format('d/m/Y H:i'),  
                'total' => number_format(array_reduce($carrito, fn($carry, $item) => $carry + $item['precio'] * $item['cantidad'], 2)),  
                'productos' => $carrito,  
                'estado_pedido' => 'Pendiente',  
            ]);  
        } catch (\Exception $e) {  
            DB::rollBack(); // Revertir los cambios si hay un error  
            return redirect()->route('home')->with('error', 'Error al procesar el pago: ' . $e->getMessage());  
        }  
    }  

    public function pagoFallido()  
    {  
        return redirect()->route('resumen.pedido')->with('error', 'El pago no se pudo completar.');  
    }  
}  