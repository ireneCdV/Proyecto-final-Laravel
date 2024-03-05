<x-app-layout>
    <main class="my-8 bg-gray-800 text-white">
        <div class="container px-6 mx-auto">
            <div class="flex justify-center my-6">
                <div class="flex flex-col w-full p-8 bg-gray-900 shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5">
                    @if ($message = Session::get('success'))
                    <div class="p-4 mb-3 bg-blue-400 rounded">
                        <p class="text-white">{{ $message }}</p>
                    </div>
                    @endif
                    <h3 class="text-3xl font-bold">Carrito</h3>
                    <div class="flex-1">
                        <table class="w-full text-sm lg:text-base" cellspacing="0">
                            <thead>
                                <tr class="h-12 uppercase">
                                    <th class="hidden md:table-cell"></th>
                                    <th class="text-left">Nombre</th>
                                    <th class="pl-5 text-left lg:text-right lg:pl-0">
                                        <span class="lg:hidden" title="Quantity">Qtd</span>
                                        <span class="hidden lg:inline">Cantidad</span>
                                    </th>
                                    <th class="hidden text-right md:table-cell">Precio</th>
                                    <th class="hidden text-right md:table-cell">Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $item)
                                <tr>
                                    <td class="hidden pb-4 md:table-cell" style="width:230px;">
                                        <a href="#">
                                            <img src="{{ $item->attributes->image }}" class="w-[200px] rounded"
                                                alt="Thumbnail">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#">
                                            <p class="mb-2 font-bold">{{ $item->name }}</p>
                                        </a>
                                    </td>
                                    <td class="justify-center mt-6 md:justify-end md:flex">
                                        <div class="h-10 w-28">
                                            <div class="relative flex flex-row w-full h-8">
                                                <form action="{{ route('cart.update') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}" class="">
                                                    <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                        class="w-full text-center h-10 text-gray-800 outline-none rounded border border-gray-600 py-3" />
                                                    <button
                                                        class="w-full px-4 mt-1 py-1.5 text-sm rounded shadow text-white bg-gray-800">Actualizar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="hidden text-right md:table-cell">
                                        <span class="text-sm font-medium lg:text-base">
                                            {{ $item->price }}€
                                        </span>
                                    </td>
                                    <td class="hidden text-right md:table-cell">
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{ $item->id }}" name="id">
                                            <button class="px-3 py-1 text-white bg-gray-800 shadow rounded-full">
                                                <img src="imagenes/logoDelete.jpg" alt="Texto alternativo de la imagen"
                                                    height="20px" width="20px">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="flex justify-between items-center my-5">
                            <div class="font-semibold text-2xl">Total: {{ Cart::getTotal() }}€</div>
                            <div>
                                <form action="{{ route('cart.clear') }}" method="POST">
                                    @csrf
                                    <button class="px-6 py-2 text-sm rounded shadow text-white bg-red-800">Limpiar
                                        carrito</button>
                                </form>
                                <form action="{{ route('checkout') }}" method="GET">
                                    @csrf
                                    <button
                                        class="px-6 py-2 mt-3 text-sm rounded shadow text-white bg-blue-800">Realizar
                                        Pedido</button>
                                </form>
                                <br>
                                <div>
                                    <a href="{{ route('products.list') }}" class="px-6 py-2 mt-3 text-sm rounded shadow text-white-800 hover:text-white-900 underline">Seguir comprando</a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>