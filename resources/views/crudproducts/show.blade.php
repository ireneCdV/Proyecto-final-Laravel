{{-- @extends('default')

@section('content')

	{{ $crudproduct->id }}

@stop --}}


@extends('default')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('storage/' . $crudproduct->image) }}" alt="{{ $crudproduct->name }}" class="img-fluid">

            </div>
            <div class="col-md-6">
                <h2 style="font-size: 28px; margin-bottom: 20px;">{{ $crudproduct->name }}</h2>
                <p style="margin-bottom: 20px;"><strong>Descripción:</strong> {{ $crudproduct->description }}</p>
                <p style="margin-bottom: 20px;"><strong>Precio:</strong> {{ $crudproduct->price }}€</p>
                <p style="margin-bottom: 20px;"><strong>Stock:</strong> {{ $crudproduct->stock }} unidades</p>
                <p style="margin-bottom: 20px;"><strong>Marca:</strong> {{ $crudproduct->brand }}</p>
                {{-- Agrega más información según sea necesario --}}
                
                {{-- Botón para añadir al carrito --}}
                <form action="{{ route('cart.store') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $crudproduct->id }}" name="id">
                    <input type="hidden" value="{{ $crudproduct->name }}" name="name">
                    <input type="hidden" value="{{ $crudproduct->price }}" name="price">
                    <input type="hidden" value="{{ $crudproduct->image }}" name="image">
                    <input type="hidden" value="1" name="quantity">
                    <button type="submit" style="background-color: #D597AE"; class="btn">Añadir al carrito</button>
                </form>

                {{-- Botón para volver a la página anterior --}}
                <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Volver</a>
            </div>
        </div>
    </div>

@stop


