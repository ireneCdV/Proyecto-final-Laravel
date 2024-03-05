<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 style="text-align: center">Detalles del Pedido:</h1>

                    <!-- Información de los productos en el carrito -->
                    <div class="mt-4">
                        <h2>Detalles del carrito:</h2>
                        <ul>
                            @foreach ($cartItems as $item)
                                <li>{{ $item->name }} - Cantidad: {{ $item->quantity }} - Precio: {{ $item->price }}€</li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- Mostrar el total del pedido -->
                    <div class="font-semibold text-2xl">Total: {{ Cart::getTotal() }}€</div>

                    <!-- Información del usuario registrado -->
                    <div class="mt-4">
                        <h2>Información del Usuario:</h2>
                        <p>Nombre: {{ Auth::user()->name }}</p>
                        <p>Apellidos: {{ Auth::user()->surname }}</p>
                        <p>Teléfono: {{ Auth::user()->phone }}</p>
                        <p>Dirección: {{ Auth::user()->address }}</p>
                        <p>Email: {{ Auth::user()->email }}</p>
                    </div>

                    <!-- Botón para finalizar compra -->
                    <div class="mt-4">
                        <form action="{{ route('finalizar-compra') }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Finalizar Compra
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>