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
                            <button class="mostrar-detalles-btn  underline"  data-factura-id="{{ $factura->id }}">Mostrar detalles</button>
                            <a href="{{ route('descargar_pdf', ['invoice_id' => $factura->id]) }}" class="descargar-pdf-btn ">Descargar PDF</a>


                            <div class="detalles-factura" style="display: none; margin-top: 10px;">
                                <h3>Detalles de la factura:</h3>
                                <div class="factura-container">
                                    <div class="factura-header">
                                        <div class="factura-info">
                                            <p>Factura #{{ $factura->num_invoice }}</p>
                                            <p>Fecha: {{ $factura->date }}</p>
                                        </div>
                                        <div class="factura-total">
                                            <p>Precio Total: {{$factura->total }}€</p>
                                        </div>
                                    </div>
                                    <div class="factura-items">
                                        @foreach($factura->line as $linea)
                                        <div class="factura-item">
                                            <div class="item-info">
                                                <p class="item-name">{{$linea->product->name}}</p>
                                                <p class="item-description">{{$linea->product->description }}</p>
                                            </div>
                                            <div class="item-quantity-price">
                                                <p class="item-quantity">{{$linea->amount }}</p>
                                                <p class="item-price">{{$linea->product->price}}€</p>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
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
            const detallesFactura = btn.parentNode.querySelector('.detalles-factura');
            if (detallesFactura.style.display === 'none' || detallesFactura.style.display === '') {
                detallesFactura.style.display = 'block';
            } else {
                detallesFactura.style.display = 'none';
            }
        });
    });
</script>

    

    <!-- Sección de estilos -->
    {{-- @section('styles') --}}
    <link href="{{ asset('css/facturas.css') }}" rel="stylesheet">
    {{-- @endsection --}}
</x-app-layout>