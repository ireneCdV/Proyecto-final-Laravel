@extends('default')

@section('content')
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">

	<h2>Información del Usuario</h2>
<br>
	@if ($crudcita->usuario)
		<p>Nombre: {{ $crudcita->usuario->name }}</p>
		<p>Email: {{ $crudcita->usuario->email }}</p>
		<!-- Agrega más campos del usuario si los necesitas -->
	@else
		<p>No se encontró información del usuario.</p>
	@endif
<br>
	<h2>Información de la Cita</h2>
<br>
    <p>ID de la Cita: {{ $crudcita->id }}</p>
    <p>Fecha: {{ $crudcita->fecha }}</p>
    <p>Hora: {{ $crudcita->hora }}</p>
    <p>Servicio ID: {{ $crudcita->servicio_id }}</p>

    

@stop
