@extends('default')

@section('content')

<style>
    .tarjeta {
        background-image: url('/imagenes/tarjetas.jpg'); 
        background-repeat: no-repeat; /* Evita que la imagen se repita */
        background-size: cover; /* Ajusta la imagen de fondo para cubrir todo el contenedor */
        height: 300px; /* Altura deseada de la imagen de fondo */
        width: 1000px; /* Ancho deseado de la imagen de fondo */
        font-size: 16px;
        color: beige;
    }
</style>



    <div class="tarjeta">
        {{-- Contenido de la vista --}}
        <div>
            {{-- <p>ID de la cita: {{ $cita->id }}</p> --}}
            <p>Fecha: {{ $cita->fecha }}</p>
            <br>
            <p>Hora: {{ $cita->hora }}</p>
            <br>
            <p>Servicio: {{ $servicio->name }}</p> 
            <br>
            <p>Nota: El servicio se pagará después de realizarlo en la peluquería. Gracias por confiar.</p>
        </div>
    </div>

@stop
