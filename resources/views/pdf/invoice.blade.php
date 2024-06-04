<!DOCTYPE html>
<html>

<head>
    <title>Factura</title>

    <style>
        /* CSS Factura PDF */

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #ffffff;
            color: #333333;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #cccccc;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .invoice-header img {
            width: 120px;
            height: auto;
        }

        .invoice-header h1 {
            margin: 0;
            font-size: 24px;
            color: #333333;
        }

        .invoice-header .contact-info {
            text-align: right;
        }

        .invoice-header .contact-info .payment-status {
            background-color: #f8f8f8;
            border: 1px solid #cccccc;
            padding: 10px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .invoice-header .contact-info p {
            margin: 5px 0;
            font-size: 14px;
        }

        .invoice-details {
            margin-bottom: 20px;
        }

        .invoice-details h1 {
            text-align: center;
            font-size: 20px;
            margin-bottom: 20px;
            color: #444444;
        }

        .details-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .details-column {
            width: 32%;
        }

        .details-column p {
            margin: 2px 0;
            font-size: 14px;
        }

        .order-details {
            font-size: 12px;
            margin-bottom: 10px;
        }

        .order-details p {
            margin: 2px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            border: 1px solid #cccccc;
            padding: 10px;
            text-align: left;
            font-size: 14px;
        }

        table th {
            background-color: #f8f8f8;
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .total {
            text-align: right;
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px;
        }

        footer {
            text-align: center;
            font-size: 12px;
            color: #777777;
            margin-top: 20px;
            border-top: 1px solid #cccccc;
            padding-top: 10px;
        }
    </style>
</head>

<body>
    <div class="invoice-header">
        <img src="{{ public_path('imagenes/logo.jpg') }}" alt="Logo">
        <h1>Estilo & Tijeras</h1>
        <div class="contact-info">
            <div class="payment-status">Pago realizado con éxito</div>
            <p>Telefono: 900 900 900</p>
            <p>estiloytijeras@gmail.com</p>
        </div>
    </div>

    <div class="invoice-details">
        <div class="details-section">
            <div class="details-column">
                <p><strong>Dirección de facturación</strong></p>
                <p>Nombre: {{ $user->name }}</p>
                <p>Apellidos: {{ $user->surname }}</p>
                <p>Teléfono: {{ $user->phone }}</p>
                <p>Dirección: {{ $user->address }}</p>
                <p>Email: {{ $user->email }}</p>
            </div>
            <div class="details-column">
                <p><strong>Dirección de envío</strong></p>
                <p>Nombre: {{ $user->name }}</p>
                <p>Apellidos: {{ $user->surname }}</p>
                <p>Teléfono: {{ $user->phone }}</p>
                <p>Dirección: {{ $user->address }}</p>
                <p>Email: {{ $user->email }}</p>
            </div>
        </div>

        <div class="order-details">
            <p><strong>Información del pedido</strong></p>
            <p>Fecha del pedido: {{ $invoice->date }}</p>
            <p>Número del pedido: {{ $invoice->num_invoice }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice->line as $linea)
                <tr>
                    <td>{{ $linea->product->name }}</td>
                    <td>{{ $linea->amount }}</td>
                    <td>{{ $linea->product->price }}€</td>
                    <td>{{ $linea->amount * $linea->product->price }}€</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="invoice-summary">
            <p class="total">Total de la factura: {{ $invoice->total }}€</p>
        </div>
    </div>

    <footer>
        Gracias por confiar en nosotros, atentamente el equipo de Estilo & Tijeras.
    </footer>
</body>

</html>