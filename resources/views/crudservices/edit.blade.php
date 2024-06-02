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
			{{ Form::label('name', 'Name', ['class'=>'form-label']) }}
			{{ Form::text('name', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('price', 'Price', ['class'=>'form-label']) }}
			{{ Form::text('price', null, array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Editar', array('class' => 'btn', 'style' => 'background-color: ##0D6EFD')) }}

	{{ Form::close() }}
@stop
