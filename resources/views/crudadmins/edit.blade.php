@extends('default')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{{ Form::model($crudadmin, array('route' => array('crudadmins.update', $crudadmin->id), 'method' => 'PUT')) }}

		<div class="mb-3">
			{{ Form::label('name', 'Nombre', ['class'=>'form-label']) }}
			{{ Form::text('name', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('surname', 'Apellidos', ['class'=>'form-label']) }}
			{{ Form::text('surname', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('phone', 'Telefono', ['class'=>'form-label']) }}
			{{ Form::text('phone', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('address', 'Apellidos', ['class'=>'form-label']) }}
			{{ Form::text('address', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('dni', 'Dni', ['class'=>'form-label']) }}
			{{ Form::text('dni', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('email', 'Email', ['class'=>'form-label']) }}
			{{ Form::text('email', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('password', 'Contraseña', ['class'=>'form-label']) }}
			{{ Form::text('password', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('cod_admin', 'Codigo de administrador', ['class'=>'form-label']) }}
			{{ Form::text('cod_admin', null, array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Editar', array('class' => 'btn btn-primary')) }}
		

	{{ Form::close() }}

	<a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Volver</a>
@stop
