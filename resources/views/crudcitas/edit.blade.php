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

{{ Form::model($crudcita, array('route' => array('crudcitas.update', $crudcita->id), 'method' => 'PUT')) }}

<div class="mb-3">
	{{ Form::label('user_name', 'Usuario', ['class'=>'form-label']) }}
	{{ Form::text('user_name', $crudcita->usuario->name, ['class' => 'form-control', 'readonly']) }}
</div>

<div class="mb-3">
	{{ Form::label('servicio_id', 'Servicio', ['class'=>'form-label']) }}
	{{ Form::select('servicio_id', $services->pluck('name', 'id'), $crudcita->servicio_id, ['class' => 'form-control'])
	}}
</div>

<div class="mb-3">
	{{ Form::label('fecha', 'Fecha', ['class'=>'form-label']) }}
	{{ Form::date('fecha', $crudcita->fecha, array('class' => 'form-control')) }}
</div>
<div class="mb-3">
	{{ Form::label('hora', 'Hora', ['class'=>'form-label']) }}
	{{ Form::select('hora', [
	'10:00' => '10:00 AM',
	'10:30' => '10:30 AM',
	'11:00' => '11:00 AM',
	'11:30' => '11:30 AM',
	'12:00' => '12:00 PM',
	'12:30' => '12:30 PM',
	'13:00' => '1:00 PM',
	'13:30' => '1:30 PM',
	'17:00' => '5:00 PM',
	'17:30' => '5:30 PM',
	'18:00' => '6:00 PM',
	'18:30' => '6:30 PM',
	'19:00' => '7:00 PM',
	'19:30' => '7:30 PM',
	'20:00' => '8:00 PM',
	'20:30' => '8:30 PM',
	], $crudcita->hora, ['class' => 'form-control']) }}
</div>


{{ Form::submit('Editar', array('class' => 'btn', 'style' => 'background-color: #0D6EFD')) }}

{{ Form::close() }}
@stop