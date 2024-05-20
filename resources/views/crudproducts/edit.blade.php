@extends('default')

@section('content')

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
            {{ Form::file('image', array('class' => 'form-control')) }}
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
            {{ Form::label('stock', 'Stock', ['class'=>'form-label']) }}
            {{ Form::text('stock', null, array('class' => 'form-control')) }}
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