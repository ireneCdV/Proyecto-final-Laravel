<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Facturas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>Todas tus facturas:</h1>

                    @if($facturas->isEmpty())
                    <p>No tienes facturas aún.</p>
                    @else
                    <ul>
                        @foreach($facturas as $factura)
                        <li>
                            Factura #{{ $factura->num_invoice }} - Fecha: {{ $factura->date }} - Precio Total: {{$factura->total }}€
                            <button class="mostrar-detalles-btn" data-factura-id="{{ $factura->id }}">Mostrar detalles</button>

                            <div class="detalles-factura" style="display: none; margin-top: 10px;">
                                <h3>Detalles de la factura:</h3>
                                <table style="width: 100%; border-collapse: collapse;">
                                    <thead>
                                        <tr>
                                            <th style="border: 1px solid #ddd; padding: 8px;">Nombre</th>
                                            <th style="border: 1px solid #ddd; padding: 8px;">Descripción</th>
                                            <th style="border: 1px solid #ddd; padding: 8px;">Cantidad</th>
                                            <th style="border: 1px solid #ddd; padding: 8px;">Precio unid</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($factura->line as $linea)
                                        <tr>
                                            <td style="border: 1px solid #ddd; padding: 8px;">{{$linea->product->name}}</td>
                                            <td style="border: 1px solid #ddd; padding: 8px;"> {{$linea->product->description }}</td>
                                            <td style="border: 1px solid #ddd; padding: 8px;">{{$linea->amount }}</td>
                                            <td style="border: 1px solid #ddd; padding: 8px;">{{$linea->product->price}}€</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.mostrar-detalles-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const detallesFactura = btn.nextElementSibling;
                if (detallesFactura.style.display === 'none' || detallesFactura.style.display === '') {
                    detallesFactura.style.display = 'block';
                } else {
                    detallesFactura.style.display = 'none';
                }
            });
        });
    </script>
</x-app-layout>