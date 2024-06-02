<x-app-layout>
    @section('scripts')
    <script src="{{ asset('js/products.js') }}"></script>
    @endsection
    <link href="{{ asset('css/product/product.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" style="text-align: center">
            {{ __('Productos') }}
        </h2>
    </x-slot>

    <div class="py-12 background-animation">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form id="product-filter-form" method="GET" action="{{ route('products.list') }}">
                        <div class="mb-4">
                            {{-- Buscar --}}
                            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="search">
                                Que estas buscado:
                            </label>
                            <input type="text" name="search" id="search" 
                                class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        {{-- Filtro Marca --}}
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="brand">Marca:</label>
                        <select name="brand" id="brand" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="" disabled selected>Todas las marcas</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand }}">{{ $brand }}</option>
                            @endforeach
                        </select>
                        
                        {{-- Filtro Categorias --}}
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

                        {{-- Ordenar por --}}
                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="orderBy">
                                Ordenar por:
                            </label>
                            <select name="orderBy" id="orderBy"
                            class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="" disabled selected>Seleccione una opción</option>
                            <option value="asc">Precio más bajo</option>
                            <option value="desc">Precio más alto</option>
                            <option value="stock_desc">Más stock</option>
                            <option value="stock_asc">Menos stock</option>
                        </select>
                        </div>

                        <button type="submit" class="metal-silver font-bold py-2 px-4">Ordenar</button>

                    </form>
                    <br>

                    @if($products->isEmpty())
                        <p>No se encontraron productos con el término de búsqueda proporcionado.</p>
                    @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 gap-4">
                        @foreach($products as $product)
                            <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg mb-4 tarjeta">
                                <div class="p-4">
                                    <div class="flex">
                                        <button type="button" class="favorito-btn" onclick="toggleFavorito({{ $product->id }})">
                                            <span id="icono-{{ $product->id }}">🤍</span>
                                        </button>
                                        <div>
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                                class="w-48 h-48 object-cover" height="200px" width="200px">
                                        </div>
                                        <div class="ml-4">
                                            <h3 class="text-xl font-semibold">Nombre: {{ $product->name }}</h3>
                                            <p class="text-gray-600">Precio: {{ $product->price }}€</p>
                                            <p class="text-gray-600">Stock: {{ $product->stock }} unidades</p>
                                            <p class="text-gray-600">Marca: {{ $product->brand }}</p>
                    
                                            @if($product->stock > 0)
                                            <form action="{{ route('cart.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ $product->id }}" name="id">
                                                <input type="hidden" value="{{ $product->name }}" name="name">
                                                <input type="hidden" value="{{ $product->price }}" name="price">
                                                <input type="hidden" value="{{ $product->image }}" name="image">
                                                <input type="hidden" value="1" name="quantity">
                    
                                                <button type="submit" class="button-gold py-2 px-4 mt-2">
                                                    Añadir al carrito
                                                </button>
                    
                                                <a href="{{ route('productos.show', [$product->id]) }}" class="ml-2 metal-silver">
                                                    Ver Detalles
                                                </a>
                                            </form>
                                            @else
                                                <p class="text-red-500">Producto agotado</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    </div>
                    @endif
                    {{$products->links()}} 
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Función para alternar el estado de favorito de un producto
        function toggleFavorito(productoId) {
            let favoritos = JSON.parse(localStorage.getItem('favoritos')) || [];

            if (favoritos.includes(productoId)) {
                // Si el producto ya es favorito, removerlo
                favoritos = favoritos.filter(id => id !== productoId);
            } else {
                // Si el producto no es favorito, agregarlo
                favoritos.push(productoId);
            }

            localStorage.setItem('favoritos', JSON.stringify(favoritos));
            actualizarIconoFavorito(productoId);
        }

        // Función para actualizar el icono de favorito según el estado
        function actualizarIconoFavorito(productoId) {
            let favoritos = JSON.parse(localStorage.getItem('favoritos')) || [];
            let icono = document.getElementById(`icono-${productoId}`);

            if (favoritos.includes(productoId)) {
                icono.textContent = '\u2764'; // Icono de favorito marcado
                icono.classList.remove('desmarcado');
                icono.classList.add('marcado');
            } else {
                icono.textContent = '🤍'; // Icono de favorito desmarcado
                icono.classList.remove('marcado');
                icono.classList.add('desmarcado');
            }
        }

        // Función para inicializar el estado de los iconos de favoritos al cargar la página
        function inicializarFavoritos() {
            let favoritos = JSON.parse(localStorage.getItem('favoritos')) || [];
            favoritos.forEach(productoId => {
                actualizarIconoFavorito(productoId);
            });
        }

        // Ejecutar la función de inicialización al cargar la página
        document.addEventListener('DOMContentLoaded', inicializarFavoritos);
    </script>
</x-app-layout>