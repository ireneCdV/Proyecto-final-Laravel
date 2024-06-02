@extends('default')

@section('content')
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
	<p>Id: {{$crudcategory->id }}</p>
	<p>Nombre: {{ $crudcategory->title }}</p>

	<a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Volver</a>
	
	

@stop