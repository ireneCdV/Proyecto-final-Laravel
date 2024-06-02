@extends('default')

@section('content')

<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
<link href="{{ asset('css/citas/citas.css') }}" rel="stylesheet">

<nav class="d-flex justify-content-between mb-3">
    <a href="{{ route('citas.create') }}" class="button-gold mt-3">Nueva cita</a>
    <div id="image-scroll-left" class="image-scroll">
        <!-- Contenedor de imágenes izquierdo -->
        <div class="image-container">
            <img src="{{ asset('imagenes/servicio1.jpg') }}" alt="Image 1">
            <img src="{{ asset('imagenes/servicio2.jpg') }}" alt="Image 2">
            <img src="{{ asset('imagenes/servicio3.jpg') }}" alt="Image 3">
            <img src="{{ asset('imagenes/servicio4.jpg') }}" alt="Image 4">
            <img src="{{ asset('imagenes/servicio5.jpg') }}" alt="Image 5">
        </div>
    </div>
    <div id="image-scroll-right" class="image-scroll">
        <!-- Contenedor de imágenes derecho -->
        <div class="image-container reverse">
            <img src="{{ asset('imagenes/servicio6.jpg') }}" alt="Image 6">
            <img src="{{ asset('imagenes/servicio7.jpg') }}" alt="Image 7">
            <img src="{{ asset('imagenes/servicio8.jpg') }}" alt="Image 8">
            <img src="{{ asset('imagenes/servicio9.jpg') }}" alt="Image 9">
            <img src="{{ asset('imagenes/servicio10.jpg') }}" alt="Image 10">
        </div>
    </div>
</nav>

<!-- Mensajes de error -->
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<!-- Formulario para filtro de estado -->
<form method="GET" action="{{ route('citas.index') }}">
    <div class="row mb-4">
        <div class="col">
            <select name="estado" class="form-control">
                <option value="1" {{ request('estado') == '1' ? 'selected' : '' }}>Pendientes</option>
                <option value="0" {{ request('estado') == '0' ? 'selected' : '' }}>Pasadas</option>
            </select>
        </div>
        <div class="col">
            <button type="submit" class=" metal-silver mt-3">Filtrar</button>
        </div>
    </div>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Servicio</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($citas as $cita)
        <tr>
            <td>{{ $cita->fecha }}</td>
            <td>{{ $cita->hora }}</td>
            <td>{{ $cita->servicio_id }}</td>
            <td>
                <div class="d-flex gap-2">
                    <a href="{{ route('citas.show', [$cita->id]) }}" class="btn btn-info button-gold">Ver</a>
                    <a href="{{ route('citas.edit', [$cita->id]) }}" class="btn metal-silver">Modificar</a>
                    <a href="{{ route('citas.destroy', [$cita->id]) }}" class="btn metal-rose-gold"
                        onclick="event.preventDefault(); if(confirm('¿Estás seguro de que deseas eliminar esta cita?')) { document.getElementById('delete-form-{{$cita->id}}').submit();}">
                        Eliminar
                    </a>
                    <form id="delete-form-{{$cita->id}}" action="{{ route('citas.destroy', [$cita->id]) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@stop
