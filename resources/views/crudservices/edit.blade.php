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

	{{ Form::model($crudservice, array('route' => array('crudservices.update', $crudservice->id), 'method' => 'PUT')) }}

		<div class="mb-3">
			{{ Form::label('name', 'Nombre', ['class'=>'form-label']) }}
			{{ Form::text('name', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('price', 'Precio', ['class'=>'form-label']) }}
			{{ Form::text('price', null, array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Editar', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}

	{{-- Botón para volver a la página anterior --}}
	<a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Volver</a>
@stop
