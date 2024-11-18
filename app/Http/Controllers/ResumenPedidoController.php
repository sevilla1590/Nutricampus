<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    
        // Verificar que las cantidades sean coherentes
        $total = array_reduce($carrito, function ($carry, $item) {
            return $carry + ($item['precio'] * $item['cantidad']);
        }, 0);

        // Configurar Mercado Pago
        MercadoPagoConfig::setAccessToken(env('MERCADOPAGO_ACCESS_TOKEN'));

        // Construir los items para Mercado Pago
        $items = [];
        foreach ($carrito as $item) {
            $items[] = [
                "title" => $item['nombre'], // Nombre del producto
                "quantity" => $item['cantidad'], // Cantidad de productos
                "unit_price" => (float) $item['precio'], // Precio unitario, convertido a float
            ];
        }

        // Crear preferencia en Mercado Pago
        $client = new PreferenceClient();
        try {
            $preference = $client->create([
                "items" => $items, // Pasamos el array correctamente construido
                "back_urls" => [
                    "success" => route('pago.exitoso'),
                    "failure" => route('pago.fallido'),
                    "pending" => route('pago.pendiente'),
                ],
                "auto_return" => "approved",
            ]);

            // Renderizar la vista con los datos
            return view('resumenpedido', compact('carrito', 'total', 'preference'));
        } catch (\Exception $e) {
            // Manejar errores de API
            return redirect()->route('carrito.ver')->with('error', 'Error al procesar el pago: ' . $e->getMessage());
        }
    }
}
