@extends('default')

@section('content')

    <div>
        {{-- <p>ID de la cita: {{ $cita->id }}</p> --}}
        <p>Fecha: {{ $cita->fecha }}</p>
        <p>Hora: {{ $cita->hora }}</p>
		<p>Servicio: {{ $servicio->name }}</p> 
		<p>Nota: El servicio se pagara despues de hacerlo en la peluqueria, Gracias por confiar.</p>
    </div>

@stop