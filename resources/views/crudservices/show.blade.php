@extends('default')

@section('content')

<link href="{{ asset('css/styles.css') }}" rel="stylesheet">

	

	<p>Id: {{ $crudservice->id }}</p>
	<p>Nombre: {{ $crudservice->name }}</p>
	<p>Precio: {{ $crudservice->price }}€</p>
	

@stop