@extends('layouts.layout')

@section('content')
<div class="container mx-auto my-8 px-4">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Carrito de Compras</h1>

    <!-- Mensaje de éxito -->
    @if(session('message'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- Mostrar carrito -->
    @if(count($carrito) > 0)
        <div class="bg-white rounded-lg shadow-lg p-6">
        <table class="w-full text-left">  
    <thead>  
        <tr>  
            <th class="border-b-2 p-4">Producto</th>  
            <th class="border-b-2 p-4">Cantidad</th>  
            <th class="border-b-2 p-4">Stock Disponible</th>  
            <th class="border-b-2 p-4">Precio</th>  
            <th class="border-b-2 p-4">Subtotal</th>  
            <th class="border-b-2 p-4">Acciones</th>  
        </tr>  
    </thead>  
    <tbody>  
        @foreach($carrito as $item)  
            <tr data-id="{{ $item['id'] }}">  
                <td class="border-b p-4 flex items-center">  
                    <img src="{{ asset($item['imagen']) }}" alt="{{ $item['nombre'] }}" class="w-16 h-16 mr-4">  
                    {{ $item['nombre'] }}  
                </td>  
                <td class="border-b p-4">  
                    <div class="flex items-center space-x-2">  
                        <button class="decrease bg-gray-300 px-2 py-1 rounded">-</button>  
                        <input type="text" value="{{ $item['cantidad'] }}" min="1" max="20" class="quantity-input w-12 text-center border border-gray-300 rounded" readonly />  
                        <button class="increase bg-gray-300 px-2 py-1 rounded">+</button>  
                    </div>  
                </td>  
                <td class="border-b p-4">  
                    @php  
                        $producto = DB::table('producto')->where('id', $item['id'])->first();  
                    @endphp  
                    {{ $producto->disponibilidad ?? 'N/A' }}  
                </td>  
                <td class="border-b p-4">S/ {{ number_format($item['precio'], 2) }}</td>  
                <td class="border-b p-4 subtotal">S/ {{ number_format($item['precio'] * $item['cantidad'], 2) }}</td>  
                <td class="border-b p-4">  
                    <form action="{{ route('carrito.eliminar', $item['id']) }}" method="POST">  
                        @csrf  
                        @method('DELETE')  
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">Eliminar</button>  
                    </form>  
                </td>  
            </tr>  
        @endforeach  
    </tbody>  
</table>  

            <div class="text-right mt-4">
                <h2 class="text-lg font-semibold">Total: S/ <span id="total">{{ number_format($total, 2) }}</span></h2>
                <a href="{{ route('resumen.pedido') }}" class="bg-blue-500 text-white px-4 py-2 mt-4 rounded">Realizar pago</a>
            </div>
        </div>
    @else
        <div class="bg-gray-100 text-gray-700 p-4 rounded mb-4">
            El carrito está vacío.
        </div>
    @endif
</div>

<script>
document.querySelectorAll('.decrease, .increase').forEach(button => {
    button.addEventListener('click', function () {
        const row = this.closest('tr');
        const id = row.getAttribute('data-id');
        const input = row.querySelector('.quantity-input');
        let cantidad = parseInt(input.value);

        if (this.classList.contains('decrease') && cantidad > 1) {
            cantidad--;
        } else if (this.classList.contains('increase') && cantidad < 20) {
            cantidad++;
        }

        input.value = cantidad;

        fetch(`/carrito/actualizar/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({ cantidad: cantidad }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                row.querySelector('.subtotal').innerText = `S/ ${data.subtotal.toFixed(2)}`;
                document.getElementById('total').innerText = `S/ ${data.total.toFixed(2)}`;
            } else {
                alert('Error al actualizar el carrito, cantidad solicitada supera stock disponible');
            }
        });
    });
});
</script>
@endsection
