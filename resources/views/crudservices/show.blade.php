@extends('default')

@section('content')

<link href="{{ asset('css/styles.css') }}" rel="stylesheet">

	

	<p>Id: {{ $crudservice->id }}</p>
	<p>Nombre servicio: {{ $crudservice->name }}</p>
	<p>Precio: {{ $crudservice->price }}€</p>
	
	{{-- Botón para volver a la página anterior --}}
	<a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Volver</a>

@stop