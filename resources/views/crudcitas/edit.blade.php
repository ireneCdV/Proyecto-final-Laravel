@extends('default')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{{ Form::model($crudcita, array('route' => array('crudcitas.update', $crudcita->id), 'method' => 'PUT')) }}

		<div class="mb-3">
			{{ Form::label('fecha', 'Fecha', ['class'=>'form-label']) }}
			{{ Form::text('fecha', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('hora', 'Hora', ['class'=>'form-label']) }}
			{{ Form::text('hora', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('servicio_id', 'Servicio_id', ['class'=>'form-label']) }}
			{{ Form::text('servicio_id', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('user_id', 'User_id', ['class'=>'form-label']) }}
			{{ Form::text('user_id', null, array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Editar', array('class' => 'btn', 'style' => 'background-color: ##0D6EFD')) }}

	{{ Form::close() }}
@stop
