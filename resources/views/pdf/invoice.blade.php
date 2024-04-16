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
        <h1>Factura {{$invoice->id}}</h1>
    </div>

    <div>
        <p>Nombre: {{ $user->name }}</p>
        <p>Apellidos: {{ $user->surname }}</p>
        <p>Telefono: {{ $user->phone }}</p>
        <p>Direccion: {{ $user->address }}</p>
        <p>Email: {{ $user->email }}</p>
    </div>

    <div class="invoice-details">
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
</body>
</html>
