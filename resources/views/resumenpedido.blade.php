@extends('layouts.layout')

@section('content')
<div class="container mx-auto my-8 px-4">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Resumen del Pedido</h1>
    <div class="bg-white rounded-lg shadow-lg p-6">
        <table class="w-full text-left mb-4">
            <thead>
                <tr>
                    <th class="border-b-2 p-4">Producto</th>
                    <th class="border-b-2 p-4">Cantidad</th>
                    <th class="border-b-2 p-4">Precio</th>
                    <th class="border-b-2 p-4">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($carrito as $item)
                <tr>
                    <td class="border-b p-4">{{ $item['nombre'] }}</td>
                    <td class="border-b p-4">{{ $item['cantidad'] }}</td>
                    <td class="border-b p-4">S/ {{ number_format($item['precio'], 2) }}</td>
                    <td class="border-b p-4">S/ {{ number_format($item['precio'] * $item['cantidad'], 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-right">
            <h2 class="text-lg font-semibold">Total: S/ {{ number_format($total, 2) }}</h2>
        </div>

        <div class="mt-4">
            <button id="pagar" class="bg-blue-500 text-white px-4 py-2 rounded">Pagar con Mercado Pago</button>
        </div>
    </div>
</div>

<script src="https://sdk.mercadopago.com/js/v2"></script>
<script>
    const mp = new MercadoPago("{{ env('MERCADOPAGO_PUBLIC_KEY') }}");

    document.getElementById('pagar').addEventListener('click', function () {
        mp.checkout({
            preference: {
                id: "{{ $preference->id }}"
            },
            autoOpen: true,
        });
    });
</script>
@endsection