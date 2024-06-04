@extends('default')

@section('content')

<link href="{{ asset('css/citas/citas.css') }}" rel="stylesheet">

<div class="tarjeta">
    {{-- Contenido de la vista --}}
    <div>
        {{-- <p>ID de la cita: {{ $cita->id }}</p> --}}
        <p class="parrafo-tarjeta">Fecha: {{ $cita->fecha }}</p>
        <p class="parrafo-tarjeta">Hora: {{ $cita->hora }}</p>
        <p class="parrafo-tarjeta">Servicio: {{ $servicio->name }}</p>
        <p class="parrafo-tarjeta">El servicio se pagará después de realizarlo.</p>
        <p class="parrafo-tarjeta">Gracias por confiar.E&T</p>
    </div>
</div>

{{-- Botón para volver a la página anterior --}}
<a href="{{ url()->previous() }}" class="metal-silver mt-3">Volver</a>

@stop
