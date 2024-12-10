<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Comprobante de Pago</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #2d3748;
            line-height: 1.4;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            /* Asegura que los elementos estén alineados verticalmente */
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e2e8f0;
            /* Línea divisoria */
        }

        .logo-container {
            width: 100px;
            /* Tamaño del logo */
            display: flex;
            align-items: center;
            /* Centra el logo verticalmente */
        }

        .logo {
            width: 100%;
            height: auto;
        }

        .header-content {
            text-align: right;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            /* Centra verticalmente el contenido */
            padding-left: 15px;
        }

        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #1a202c;
            margin: 0;
            /* Elimina márgenes */
        }

        .document-title {
            font-size: 18px;
            color: #4a5568;
            margin: 0;
            /* Elimina márgenes */
        }

        .info-section {
            background-color: #f7fafc;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .info-row {
            display: flex;
            margin-bottom: 6px;
        }

        .info-label {
            font-weight: bold;
            color: #4a5568;
            width: 130px;
        }

        .products-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }

        .products-table th {
            background-color: #edf2f7;
            color: #2d3748;
            padding: 8px;
            text-align: left;
            font-weight: bold;
            border-bottom: 1px solid #cbd5e0;
        }

        .products-table td {
            padding: 8px;
            border-bottom: 1px solid #e2e8f0;
            color: #4a5568;
        }

        .total-section {
            text-align: right;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #e2e8f0;
        }

        .total-amount {
            font-size: 18px;
            font-weight: bold;
            color: #1a202c;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #718096;
            border-top: 1px solid #e2e8f0;
            padding-top: 15px;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo-container">
            <img src="data:image/png;base64,{{ $logoBase64 }}" class="logo" alt="Logo">
        </div>
        <div class="header-content">
            <div class="company-name">NutriCampus</div>
            <div class="document-title">Comprobante de Pago</div>
        </div>
    </div>

    <div class="info-section">
        <div class="info-row">
            <span class="info-label">N° de Transacción:</span>
            <span class="info-value">{{ $payment_id }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Cliente:</span>
            <span class="info-value">{{ $cliente['nombre'] }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Email:</span>
            <span class="info-value">{{ $cliente['email'] }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Dirección:</span>
            <span class="info-value">{{ $cliente['direccion'] }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Fecha:</span>
            <span class="info-value">{{ $fecha }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Método de Pago:</span>
            <span class="info-value">{{ $metodo_pago }}</span>
        </div>
    </div>

    <table class="products-table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unit.</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto['nombre'] }}</td>
                    <td>{{ $producto['cantidad'] }}</td>
                    <td>S/ {{ number_format($producto['precio'], 2) }}</td>
                    <td>S/ {{ number_format($producto['subtotal'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-section">
        <div class="total-amount">
            Total: S/ {{ number_format($total, 2) }}
        </div>
    </div>

    <div class="footer">
        <p>Gracias por su compra</p>
        <p>Este documento es un comprobante de pago válido</p>
    </div>
</body>

</html>
