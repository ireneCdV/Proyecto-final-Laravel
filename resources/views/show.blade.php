@extends('default')

@section('content')

<link href="{{ asset('css/product/product.css') }}" rel="stylesheet">
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid border-gold">
        </div>
        <div class="col-md-6">
            <h2 style="font-size: 28px; margin-bottom: 20px;">{{ $product->name }}</h2>
            <p style="margin-bottom: 20px;"><strong>Descripción:</strong> {{ $product->description }}</p>
            <p style="margin-bottom: 20px;"><strong>Precio:</strong> {{ $product->price }}€</p>
            <p style="margin-bottom: 20px;"><strong>Stock:</strong> {{ $product->stock }} unidades</p>
            <p style="margin-bottom: 20px;"><strong>Marca:</strong> {{ $product->brand }}</p>
            <p style="margin-bottom: 20px;"><strong>Categoria:</strong> {{ $product->category->title }}</p>
            
            <form action="{{ route('cart.store') }}" method="POST">
                @csrf
                <input type="hidden" value="{{ $product->id }}" name="id">
                <input type="hidden" value="{{ $product->name }}" name="name">
                <input type="hidden" value="{{ $product->price }}" name="price">
                <input type="hidden" value="{{ $product->image }}" name="image">
                <input type="hidden" value="1" name="quantity">
                <button type="submit" style="background-color: #D597AE"; class="button-gold ">Añadir al carrito</button>
            </form>

            <a href="{{ url()->previous() }}" class="metal-silver mt-3">Volver</a>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Productos Relacionados</h1>
            <div id="productosRelacionados" class="related-products">
                @foreach($relatedProducts as $relatedProduct)
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{ asset('storage/' . $relatedProduct->image) }}" alt="{{ $relatedProduct->name }}">
                        </div>
                        <div class="product-details">
                            <h3>{{ $relatedProduct->name }}</h3>
                            <p>Precio: {{ $relatedProduct->price }}€</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Obtener el producto actual desde el almacenamiento local
        let productId = "{{ $product->id }}";
        let productViews = localStorage.getItem(`product_${productId}_views`);
        if (!productViews) {
            productViews = 0;
        }
        productViews++;
        localStorage.setItem(`product_${productId}_views`, productViews);

        // Si el producto ha sido visto más de 3 veces, cargar los productos relacionados
        if (productViews > 3) {
            mostrarProductosRelacionados({!! $relatedProducts !!});
        }
    });

    function mostrarProductosRelacionados(relatedProducts) {
        let contenedor = document.getElementById('productosRelacionados');
        contenedor.innerHTML = '';
    
        // Verificar si relatedProducts es una colección y no está vacía
        if (Array.isArray(relatedProducts) && relatedProducts.length > 0) {
            // Si es una colección, iterar sobre cada producto
            relatedProducts.forEach(producto => {
                let productoHTML = `
                    <div class="product">
                        <img src="{{ asset('storage/') }}/${producto.image}" alt="${producto.name}">
                        <h3>${producto.name}</h3>
                        <p>Precio: ${producto.price}€</p>
                        <!-- Agrega más información si es necesario -->
                    </div>
                `;
                contenedor.innerHTML += productoHTML;
            });
        } else {
            // Si no se encontraron productos relacionados, mostrar un mensaje de error
            contenedor.innerHTML = '<p>No se encontraron productos relacionados.</p>';
        }
    }
</script>

@stop
