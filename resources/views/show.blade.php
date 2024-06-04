@extends('default')

@section('content')


<link href="{{ asset('css/styles.css') }}" rel="stylesheet">

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                class="img-fluid border-gold">
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
                <button type="submit" style="background-color: #D597AE" ; class="button-gold ">Añadir al
                    carrito</button>
            </form>
            <br>
            <br>
            <a href="{{ url()->previous() }}" class="metal-silver mt-3">Volver</a>
        </div>
    </div>
</div>


@stop