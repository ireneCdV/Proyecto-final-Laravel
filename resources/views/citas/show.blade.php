@extends('default')

@section('content')

<style>
    .tarjeta {
        background-image: url('/imagenes/vercita.jpg'); 
        background-position-x: 50%;
        background-repeat: no-repeat; /* Evita que la imagen se repita */
        height: 300px; /* Altura deseada de la imagen de fondo */
        width: 1000px; /* Ancho deseado de la imagen de fondo */
        font-size: 16px;
        /* color: white; */
        display: flex; /* Activa Flexbox */
        justify-content: center; /* Centra horizontalmente */
        align-items: center; /* Centra verticalmente */
        text-align: center; /* Asegura que el texto dentro de los divs también se centre */
    }
    .tarjeta > div {
        max-width: 80%; /* Ajusta el ancho máximo del contenido */
    }
</style>

<div class="tarjeta">
    {{-- Contenido de la vista --}}
    <div>
        {{-- <p>ID de la cita: {{ $cita->id }}</p> --}}
        <p>Fecha: {{ $cita->fecha }}</p>
        <p>Hora: {{ $cita->hora }}</p>
        <p>Servicio: {{ $servicio->name }}</p>
        <p>El servicio se pagará después de realizarlo.</p>
        <p>Gracias por confiar.</p>
    </div>
</div>

{{-- Botón para volver a la página anterior --}}
<a href="{{ url()->previous() }}" class="metal-silver mt-3">Volver</a>

@stop
