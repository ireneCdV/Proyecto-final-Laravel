@extends('default')

@section('content')
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
        </div>
    @endif

    {{ Form::model($crudproduct, array('route' => array('crudproducts.update', $crudproduct->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data')) }}

    <div class="mb-3">
        {{ Form::label('image', 'Imagen', ['class'=>'form-label']) }}
        @if($crudproduct->image)
            <img src="{{ asset('storage/' . $crudproduct->image) }}" alt="Product Image" style="max-width: 200px;">
            <br>
            {{ Form::label('new_image', 'Subir nueva imagen', ['class'=>'form-label']) }}
        @endif
        {{ Form::file('new_image', array('class' => 'form-control')) }}
    </div>
        <div class="mb-3">
            {{ Form::label('name', 'Nombre', ['class'=>'form-label']) }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>
        <div class="mb-3">
            {{ Form::label('description', 'Descripcion', ['class'=>'form-label']) }}
            {{ Form::text('description', null, array('class' => 'form-control')) }}
        </div>
        <div class="mb-3">
            {{ Form::label('price', 'Precio', ['class'=>'form-label']) }}
            {{ Form::text('price', null, array('class' => 'form-control')) }}
        </div>
        <div class="mb-3">
            {{ Form::label('units', 'Unidades', ['class'=>'form-label']) }} <!-- Cambio de 'Stock' a 'Unidades' -->
            {{ Form::text('units', null, array('class' => 'form-control')) }} <!-- Cambio de 'stock' a 'units' -->
        </div>
        <div class="mb-3">
            {{ Form::label('brand', 'Marca', ['class'=>'form-label']) }}
            {{ Form::text('brand', null, array('class' => 'form-control')) }}
        </div>
        <div class="mb-3">
            {{ Form::label('category_id', 'Categoria', ['class'=>'form-label']) }}
            <select name="category_id" id="category_id" class="form-control">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $crudproduct->category_id ? 'selected' : '' }}>{{ $category->title }}</option>
                @endforeach
            </select>
        </div>

        {{ Form::submit('Editar', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
    {{-- Botón para volver a la página anterior --}}
    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Volver</a>
@stop
