<!DOCTYPE html>
<html>
<head>
    <title>Factura</title>
    <style>
        /* Estilos CSS mejorados para la factura */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #ffffff;
            color: #333333;
        }
        .invoice-header {
            background-color: #f0f0f0;
            padding: 20px;
            text-align: center;
            border-bottom: 2px solid #cccccc;
        }
        .invoice-header img {
            width: 100px;
            height: auto;
        }
        .invoice-header h1 {
            margin: 0;
            font-size: 24px;
            color: #333333;
        }
        .invoice-header p {
            margin: 5px 0;
            font-size: 14px;
        }
        .invoice-details {
            margin-top: 20px;
        }
        .invoice-details h1 {
            text-align: center;
            font-size: 20px;
            margin-bottom: 20px;
            color: #444444;
        }
        .client-details, .invoice-summary {
            margin-bottom: 20px;
        }
        .client-details p, .invoice-summary p {
            margin: 2px 0;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            border: 1px solid #cccccc;
            padding: 10px;
            text-align: left;
            font-size: 14px;
        }
        table th {
            background-color: #f8f8f8;
            font-weight: bold;
        }
        table td img {
            width: 50px;
            height: auto;
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
        <p>Telefono: 900 900 900</p>
        <p>estiloytijeras@gmail.com</p>
    </div>

    <div class="invoice-details">
        <h1>Factura simplificada</h1>
        <div class="client-details">
            <p><strong>Datos del cliente</strong></p>
            <p>Nombre: {{ $user->name }}</p>
            <p>Apellidos: {{ $user->surname }}</p>
            <p>Teléfono: {{ $user->phone }}</p>
            <p>Dirección: {{ $user->address }}</p>
            <p>Email: {{ $user->email }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice->line as $linea)
                <tr>
                    <td>
                        {{-- <img src="{{ asset('storage/' . $linea->product->image) }}" alt="{{ $linea->product->name }}"> --}}
                        {{ $linea->product->name }}
                    </td>
                    <td>{{ $linea->product->description }}</td>
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
