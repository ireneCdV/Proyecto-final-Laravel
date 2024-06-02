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
        {{ Form::label('image', 'Image', ['class'=>'form-label']) }}
        @if($crudproduct->image)
            <img src="{{ asset('storage/' . $crudproduct->image) }}" alt="Product Image" style="max-width: 200px;">
            <br>
            {{ Form::label('new_image', 'Subir nueva imagen', ['class'=>'form-label']) }}
        @endif
        {{ Form::file('new_image', array('class' => 'form-control')) }}
    </div>
        <div class="mb-3">
            {{ Form::label('name', 'Name', ['class'=>'form-label']) }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>
        <div class="mb-3">
            {{ Form::label('description', 'Description', ['class'=>'form-label']) }}
            {{ Form::text('description', null, array('class' => 'form-control')) }}
        </div>
        <div class="mb-3">
            {{ Form::label('price', 'Price', ['class'=>'form-label']) }}
            {{ Form::text('price', null, array('class' => 'form-control')) }}
        </div>
        <div class="mb-3">
            {{ Form::label('units', 'Units', ['class'=>'form-label']) }} <!-- Cambio de 'Stock' a 'Unidades' -->
            {{ Form::text('units', null, array('class' => 'form-control')) }} <!-- Cambio de 'stock' a 'units' -->
        </div>
        <div class="mb-3">
            {{ Form::label('brand', 'Brand', ['class'=>'form-label']) }}
            {{ Form::text('brand', null, array('class' => 'form-control')) }}
        </div>
        <div class="mb-3">
            {{ Form::label('category_id', 'Category', ['class'=>'form-label']) }}
            <select name="category_id" id="category_id" class="form-control">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $crudproduct->category_id ? 'selected' : '' }}>{{ $category->title }}</option>
                @endforeach
            </select>
        </div>

        {{ Form::submit('Editar', array('class' => 'btn', 'style' => 'background-color: ##0D6EFD')) }}

    {{ Form::close() }}
@stop
