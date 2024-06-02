@extends('default')

@section('content')

<link href="{{ asset('css/styles.css') }}" rel="stylesheet">

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
                <p style="margin-bottom: 20px;"><strong>Categoria:</strong> {{ $crudproduct->category->title }}</p>
                
                
                

                {{-- Botón para volver a la página anterior --}}
                <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Volver</a>
            </div>
        </div>
    </div>

@stop


