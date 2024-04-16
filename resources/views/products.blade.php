<x-app-layout>
    @section('scripts')
    <script src="{{ asset('js/products.js') }}"></script>
    @endsection
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" style="text-align: center">
            {{ __('Productos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form id="product-filter-form" method="GET" action="{{ route('products.list') }}">
                        <div class="mb-4">
                            {{-- Buscar --}}
                            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="search">
                                Buscar por nombre:
                            </label>
                            <input type="text" name="search" id="search"
                                class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        {{-- Categorias --}}
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="category">
                            Categoría:
                        </label>
                        <select name="category" id="category"
                            class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="" disabled selected>Seleccione una categoría</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>

                        {{-- Ordernar por --}}
                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="orderBy">
                                Ordenar por:
                            </label>
                            <select name="orderBy" id="orderBy"
                                class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="" disabled selected>Seleccione una opción</option>
                                <option value="asc">Precio más bajo</option>
                                <option value="desc">Precio más alto</option>
                            </select>
                        </div>

                        <button type="submit"
                            class="border border-gray-400 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Ordenar</button>

                    </form>
                {{-- </div> --}}

                    @if($products->isEmpty())
                        <p>No se encontraron productos con el término de búsqueda proporcionado.</p>
                    @else
                    <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-4">

                            @foreach($products as $product)
                            <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                                <div class="p-4">
                                    <div class="flex">
                                        <div>
                                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                                class="w-32 h-32 object-cover" height="200px" width="200px">
                                        </div>
                                        <div class="ml-4">
                                            <h3 class="text-xl font-semibold">Nombre: {{ $product->name }}</h3>
                                            <p class="text-gray-600">Descripción: {{ $product->description }}</p>
                                            <p class="text-gray-600">Precio: {{ $product->price }}€</p>
                                            <p class="text-gray-600">Stock: {{ $product->stock }} unidades</p>
                                            <p class="text-gray-600">Marca: {{ $product->brand }}</p>
                                            {{-- Botón para añadir al carrito el producto --}}
                                            <form action="{{ route('cart.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ $product->id }}" name="id">
                                                <input type="hidden" value="{{ $product->name }}" name="name">
                                                <input type="hidden" value="{{ $product->price }}" name="price">
                                                <input type="hidden" value="{{ $product->image }}" name="image">
                                                <input type="hidden" value="1" name="quantity">
                                                <button type="submit"
                                                    class="border border-gray-400 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2">Añadir
                                                    al carrito</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    
</x-app-layout>