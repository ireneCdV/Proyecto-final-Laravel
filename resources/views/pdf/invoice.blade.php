<!DOCTYPE html>
<html>
<head>
    <title>Factura</title>
    <style>
        /* Estilos CSS para la factura */
        body {
            font-family: Arial, sans-serif;
        }
        .invoice-header {
            background-color: #f0f0f0;
            padding: 20px;
            text-align: center;
        }
        .invoice-header h1 {
            margin: 0;
        }
        .invoice-details {
            margin-top: 20px;
        }
        .invoice-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-details table th,
        .invoice-details table td {
            border: 1px solid #ccc;
            padding: 8px;
        }
    </style>
</head>
<body>
    <div class="invoice-header">
        <img src="{{ public_path('imagenes/logo.jpg') }}" alt="Logo" style="width: 100px; height: auto;">
        <div>
            <h1 style="margin: 0;">Estilo & Tijeras</h1>
            <p style="margin: 5px 0;">Telefono: 900 900 900</p>
            <p style="margin: 5px 0;">estiloytijeras@gmail.com</p>
        </div>
    </div>

    <div class="invoice-details">
        <h1 style="text-align: center">Factura simplificada</h1>
        <p>Datos del cliente</p>
        <p>Nombre: {{ $user->name }}</p>
        <p>Apellidos: {{ $user->surname }}</p>
        <p>Telefono: {{ $user->phone }}</p>
        <p>Direccion: {{ $user->address }}</p>
        <p>Email: {{ $user->email }}</p>

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
                        <td>{{ $linea->product->name }}</td>
                        <td>{{ $linea->product->description }}</td>
                        <td>{{ $linea->amount }}</td>
                        <td>{{ $linea->product->price }}€</td>
                        <td>{{ $linea->amount * $linea->product->price }}€</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            <p>Total de la factura: {{ $invoice->total }}€</p>
        </div>
    </div>
    <footer>
        Gracias por confiar en nosotros, atentamente el equipo de Estilo & Tijeras.
    </footer>
</body>
</html>
