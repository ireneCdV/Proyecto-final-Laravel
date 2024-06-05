@extends('default')

@section('content')
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
<link href="{{ asset('css/citas/citas.css') }}" rel="stylesheet">

<div class="container">
    <h2>Información del Usuario</h2>
    <div class="row">
        <div class="col-md-6">
            @if ($crudcita->usuario)
                <p><strong>Nombre:</strong> {{ $crudcita->usuario->name }}</p>
				<p><strong>Telefono:</strong> {{ $crudcita->usuario->phone }}</p>
                <p><strong>Email:</strong> {{ $crudcita->usuario->email }}</p>
                
            @else
                <p>No se encontró información del usuario.</p>
            @endif
        </div>
    </div>

    <h2>Información de la Cita</h2>
    <div class="row">
        <div class="col-md-6">
            <p><strong>ID de la Cita:</strong> {{ $crudcita->id }}</p>
            <p><strong>Fecha:</strong> {{ $crudcita->fecha }}</p>
            <p><strong>Hora:</strong> {{ $crudcita->hora }}</p>
            <p><strong>Servicio:</strong> {{ $crudcita->service->name }}</p>
        </div>
    </div>
</div>

{{-- Botón para volver a la página anterior --}}
<a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Volver</a>

@stop
