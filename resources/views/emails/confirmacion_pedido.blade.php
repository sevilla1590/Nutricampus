<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Pedido - NutriCampus</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', 'Helvetica Neue', Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 20px;
            line-height: 1.6;
        }

        .main-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background-color: #4CAF50;
            padding: 30px 20px;
            text-align: center;
            color: white;
        }

        .brand-name {
            font-size: 36px;
            font-weight: 700;
            letter-spacing: 2px;
            margin: 0 0 15px 0;
            text-transform: uppercase;
            color: #FFD700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            font-family: 'Poppins', sans-serif;
            display: inline-block;
            position: relative;
        }

        .content {
            padding: 30px;
        }

        h1 {
            color: #FF5722;
            font-size: 24px;
            margin: 0 0 20px;
            text-align: center;
        }

        .order-details {
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            padding: 12px;
            border-bottom: 1px solid #eee;
            margin-bottom: 10px;
        }

        .order-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .total {
            background-color: #FF5722;
            color: white;
            padding: 15px;
            border-radius: 8px;
            text-align: right;
            font-size: 1.2em;
            font-weight: bold;
            margin: 20px 0;
        }

        .message {
            background-color: #e8f5e9;
            border-left: 4px solid #4CAF50;
            padding: 15px;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
        }

        .footer {
            background-color: #f5f5f5;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #eee;
        }

        .social-links {
            margin-top: 15px;
        }

        .social-links a {
            color: #4CAF50;
            text-decoration: none;
            margin: 0 10px;
            font-weight: bold;
        }

        .social-links a:hover {
            color: #FF5722;
        }

        .status-badge {
            background-color: #4CAF50;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            display: inline-block;
            margin-bottom: 20px;
        }

        @media (max-width: 600px) {
            body {
                padding: 10px;
            }

            .content {
                padding: 20px;
            }

            .brand-name {
                font-size: 28px;
            }
        }
    </style>
</head>

<body>
    <div class="main-container">
        <div class="header">
            <div class="brand-name">NUTRICAMPUS</div>
            <h2>Confirmación de Pedido</h2>
        </div>

        <div class="content">
            <div class="status-badge">Pedido Confirmado</div>

            <h1>¡Gracias por tu pedido, {{ $pedido->cliente->nombre }}!</h1>

            <div class="message">
                <p>Hemos recibido tu pedido correctamente. A continuación encontrarás los detalles:</p>
            </div>

            <div class="order-details">
                @foreach ($pedido->detalles as $detalle)
                    <div class="order-item">
                        <div>
                            <strong>{{ $detalle->producto->nombre }}</strong>
                            <br>
                            <small>Cantidad: {{ $detalle->cantidad }}</small>
                        </div>
                        <div>
                            <strong>S/ {{ number_format($detalle->subtotal, 2) }}</strong>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="total">
                Total a pagar: S/ {{ number_format($pedido->total, 2) }}
            </div>

            <div class="message">
                <p>Pronto recibirás más actualizaciones sobre el estado de tu pedido.</p>
            </div>
        </div>

        <div class="footer">
            <p>Gracias por confiar en NutriCampus</p>
            <p>¡Esperamos que disfrutes de tu pedido!</p>

            <div class="social-links">
                <a href="https://www.facebook.com/nutricampus.pt">Facebook</a>
                <a
                    href="https://www.instagram.com/nutricampusup?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==">Instagram</a>
                <a href="https://acortar.link/3A8i6X">TikTok</a>
            </div>
        </div>
    </div>
</body>

</html>
