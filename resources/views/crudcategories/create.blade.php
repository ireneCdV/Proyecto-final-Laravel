@extends('default')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{!! Form::open(['route' => 'crudcategories.store']) !!}

		<div class="mb-3">
			{{ Form::label('title', 'Titulo', ['class'=>'form-label']) }}
			{{ Form::text('title', null, array('class' => 'form-control')) }}
		</div>


		{{ Form::submit('Crear', array('class' => 'btn btn-primary')) }}
		

	{{ Form::close() }}

	<a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Volver</a>


@stop