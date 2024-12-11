<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido Entregado - NutriCampus</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .email-container {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            background-color: #4CAF50;
            margin: -30px -30px 30px -30px;
            padding: 30px;
            border-radius: 12px 12px 0 0;
            color: white;
        }

        .success-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }

        h1 {
            color: white;
            font-size: 28px;
            margin: 0;
            padding: 10px 0;
        }

        .order-details {
            background-color: #f8faf8;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            border: 1px solid #e0e0e0;
        }

        .order-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .order-item {
            padding: 15px;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            background-color: white;
            border-radius: 6px;
        }

        .order-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .total {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            text-align: right;
            margin: 20px 0;
            font-size: 18px;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            color: #666;
        }

        .social-links {
            margin-top: 20px;
        }

        .social-links a {
            color: #4CAF50;
            text-decoration: none;
            margin: 0 10px;
            font-weight: bold;
        }

        .rating-request {
            background-color: #f8faf8;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            margin-top: 20px;
        }

        .rating-button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 6px;
            margin-top: 10px;
            font-weight: bold;
        }

        @media (max-width: 600px) {
            body {
                padding: 10px;
            }

            .email-container {
                padding: 15px;
            }

            .header {
                margin: -15px -15px 20px -15px;
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <div class="success-icon">✅</div>
            <h1>¡Tu pedido ha sido entregado!</h1>
            <p style="margin: 10px 0 0 0;">Hola, {{ $pedido->cliente->nombre }}</p>
        </div>

        <p style="text-align: center; font-size: 16px;">
            Nos complace informarte que tu pedido ha sido entregado con éxito.
            Esperamos que disfrutes de tus productos.
        </p>

        <div class="order-details">
            <h3 style="margin-top: 0; color: #4CAF50;">Detalles del Pedido:</h3>
            <ul class="order-list">
                @foreach ($pedido->detalles as $detalle)
                    <li class="order-item">
                        <div>
                            <strong>{{ $detalle->producto->nombre }}</strong>
                            <br>
                            <span style="color: #666;">Cantidad: {{ $detalle->cantidad }}</span>
                        </div>
                        <div>
                            <strong>S/ {{ number_format($detalle->subtotal, 2) }}</strong>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="total">
            <strong>Total Pagado: S/ {{ number_format($pedido->total, 2) }}</strong>
        </div>

        <div class="rating-request">
            <h3 style="color: #4CAF50; margin-top: 0;">¿Qué te pareció tu pedido?</h3>
            <p>Nos encantaría conocer tu opinión sobre tu experiencia</p>
            <a href="{{ route('contactanos') }}" class="rating-button">Calificar mi Pedido</a>
        </div>

        <div class="footer">
            <p>Gracias por confiar en NutriCampus</p>
            <p style="margin: 5px 0;">¡Esperamos verte pronto!</p>
            <div class="social-links">
                <a href="https://www.facebook.com/nutricampus.pt">Facebook</a>
                <a href="https://www.instagram.com/nutricampusup">Instagram</a>
                <a href="tps://acortar.link/3A8i6X">TikTok</a>
            </div>
        </div>
    </div>
</body>

</html>
