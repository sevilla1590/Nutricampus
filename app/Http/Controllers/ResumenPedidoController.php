<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        // Calcular el total del carrito
        $total = array_reduce($carrito, function ($carry, $item) {
            return $carry + ($item['precio'] * $item['cantidad']);
        }, 0);

        // Configurar Mercado Pago
        MercadoPagoConfig::setAccessToken(env('MERCADOPAGO_ACCESS_TOKEN'));

        // Construir los items para Mercado Pago
        $items = [];
        foreach ($carrito as $item) {
            $items[] = [
                "title" => $item['nombre'],
                "quantity" => $item['cantidad'],
                "unit_price" => (float) $item['precio'],
            ];
        }

        // Crear preferencia en Mercado Pago
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
        $cod_transaccion = $payment_id;

        $carrito = session()->get('carrito', []);
        if (empty($carrito)) {
            return redirect()->route('carrito.ver')->with('error', 'El carrito está vacío.');
        }

        // Obtener ID del cliente desde la tabla users
        $id_cliente = DB::table('users')->where('id', Auth::id())->value('id');

        if (!$id_cliente) {
            return redirect()->route('home')->with('error', 'No se encontró un cliente válido para procesar el pedido.');
        }

        // Mapear el método de pago
        $metodos_pago = [
            'credit_card' => 1,
            'bank_transfer' => 2,
            // Agregar más métodos según sea necesario
        ];

        $id_metodo_pago = $metodos_pago[$payment_type] ?? null;

        try {
            // Crear registro en la tabla pedido
            $pedido_id = DB::table('pedido')->insertGetId([
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
                'cod_transaccion' => $cod_transaccion,
            ]);

            // Insertar productos en detalle_pedido
            foreach ($carrito as $producto) {
                DB::table('detalle_pedido')->insert([
                    'id_pedido' => $pedido_id,
                    'id_producto' => $producto['id'],
                    'precio_unitario' => $producto['precio'],
                    'cantidad' => $producto['cantidad'],
                    'subtotal' => $producto['precio'] * $producto['cantidad'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Limpiar carrito
            session()->forget('carrito');

            // Renderizar vista de pago exitoso
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
            return redirect()->route('home')->with('error', 'Error al procesar el pago: ' . $e->getMessage());
        }
    }

    public function pagoFallido()
    {
        return redirect()->route('resumen.pedido')->with('error', 'El pago no se pudo completar.');
    }
}
