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

    {!! Form::open(['route' => 'crudproducts.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

        <div class="mb-3">
            <div class="mb-3">
                {{ Form::label('image', 'Imagen', ['class'=>'form-label']) }}
                {{ Form::file('image', array('class' => 'form-control')) }}
            </div>
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
			{{ Form::label('units', 'Unidades', ['class'=>'form-label']) }}
			{{ Form::text('units', null, array('class' => 'form-control')) }}
		</div>		
        <div class="mb-3">
            {{ Form::label('brand', 'Marca', ['class'=>'form-label']) }}
            {{ Form::text('brand', null, array('class' => 'form-control')) }}
        </div>
        <div class="mb-3">
            {{ Form::label('category_id', 'Categoria', ['class'=>'form-label']) }}
            <select name="category_id" id="category_id" class="form-control">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
        </div>

        {{ Form::submit('Crear', array('class' => 'btn btn-primary')) }}

    {!! Form::close() !!}
    {{-- Botón para volver a la página anterior --}}
    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Volver</a>


@stop
