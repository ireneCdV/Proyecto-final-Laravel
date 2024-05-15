@extends('default')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{{ Form::model($crudcategory, array('route' => array('crudcategories.update', $crudcategory->id), 'method' => 'PUT')) }}

		<div class="mb-3">
			{{ Form::label('title', 'Title', ['class'=>'form-label']) }}
			{{ Form::text('title', null, array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Editar', array('class' => 'btn', 'style' => 'background-color: #0D6EFD')) }}

	{{ Form::close() }}
@stop
