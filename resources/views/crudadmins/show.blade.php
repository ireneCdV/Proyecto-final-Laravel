@extends('default')

@section('content')


	<p>Id: {{ $crudadmin->id }}</p>
	<p>Nombre: {{ $crudadmin->name }}</p>
	<p>Apellidos: {{ $crudadmin->surname }}</p>
	<p>Email: {{ $crudadmin->email }}</p>
	<p>Direccion: {{ $crudadmin->address }}</p>
	<p>Telefono: {{ $crudadmin->phone }}</p>
	

@stop