@extends('default')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{!! Form::open(['route' => 'crudadmins.store']) !!}

		<div class="mb-3">
			{{ Form::label('name', 'Name', ['class'=>'form-label']) }}
			{{ Form::text('name', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('surname', 'Surname', ['class'=>'form-label']) }}
			{{ Form::text('surname', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('phone', 'Phone', ['class'=>'form-label']) }}
			{{ Form::text('phone', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('address', 'Address', ['class'=>'form-label']) }}
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
			{{ Form::label('password', 'Password', ['class'=>'form-label']) }}
			{{ Form::text('password', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('cod_admin', 'Cod_admin', ['class'=>'form-label']) }}
			{{ Form::text('cod_admin', null, array('class' => 'form-control')) }}
		</div>


		{{ Form::submit('Create', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}
	<a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Volver</a>


@stop