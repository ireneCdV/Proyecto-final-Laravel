@extends('default')

@section('content')

	

	<p>Id: {{ $crudservice->id }}</p>
	<p>Nombre: {{ $crudservice->name }}</p>
	<p>Precio: {{ $crudservice->price }}€</p>
	

@stop