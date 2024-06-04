@extends('default')

@section('content')

<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
<link href="{{ asset('css/citas/citas.css') }}" rel="stylesheet">


<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="row">
                <div class="col">
                    <img src="{{ asset('imagenes/servicio2.jpg') }}" class="d-block w-100" alt="Image 1">
                </div>
                <div class="col">
                    <img src="{{ asset('imagenes/servicio1.jpg') }}" class="d-block w-100" alt="Image 2">
                </div>
                <div class="col">
                    <img src="{{ asset('imagenes/servicio3.jpg') }}" class="d-block w-100" alt="Image 3">
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="row">
                <div class="col">
                    <img src="{{ asset('imagenes/servicio4.jpg') }}" class="d-block w-100" alt="Image 4">
                </div>
                <div class="col">
                    <img src="{{ asset('imagenes/servicio5.jpg') }}" class="d-block w-100" alt="Image 5">
                </div>
                <div class="col">
                    <img src="{{ asset('imagenes/servicio6.jpg') }}" class="d-block w-100" alt="Image 6">
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="row">
                <div class="col">
                    <img src="{{ asset('imagenes/servicio7.jpg') }}" class="d-block w-100" alt="Image 7">
                </div>
                <div class="col">
                    <img src="{{ asset('imagenes/servicio9.jpg') }}" class="d-block w-100" alt="Image 8">
                </div>
                <div class="col">
                    <img src="{{ asset('imagenes/servicio8.jpg') }}" class="d-block w-100" alt="Image 9">
                </div>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


<div class="d-flex justify-content-end mb-3"><a href="{{ route('citas.create') }}" class="button-gold mt-3">Nueva cita</a></div>


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
            <button type="submit" class="btn metal-silver border-silver mt-3">Filtrar</button>
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
            <td>{{ $cita->service->name }}</td>
            <td>
                <div class="d-flex gap-2">
                    <a href="{{ route('citas.show', [$cita->id]) }}" class="btn  button-gold border-gold">Ver</a>
                    <a href="{{ route('citas.edit', [$cita->id]) }}" class="btn metal-silver border-silver">Modificar</a>
                    <a href="{{ route('citas.destroy', [$cita->id]) }}" class="btn metal-rose-gold border-rose-gold"
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

{{-- Botón para volver a la página anterior --}}
<a href="{{ url()->previous() }}" class="metal-silver mt-3">Volver</a>

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script src="{{ asset('js/citas.js') }}"></script> <!-- Incluye citas.js al final del contenido -->



@stop

