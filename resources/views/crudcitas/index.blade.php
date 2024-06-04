@extends('default')

@section('content')
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">

<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
    {{ __('Gestion de citas') }}
</h2>
<br>

<!-- Formulario para filtros -->
<form method="GET" action="{{ route('crudcitas.index') }}">
    <label for="">Selecciona una fecha de inicio y otra de fin:</label>
    <div class="row mb-4">
        <div class="col">
            <input type="date" name="start_date" class="form-control" placeholder="Fecha inicio">
        </div>
        <div class="col">
            <input type="date" name="end_date" class="form-control" placeholder="Fecha fin">
        </div>
        <div class="col">
            <select name="estado" class="form-control">
                <option value="">Todos</option>
                <option value="1">Pendientes</option>
                <option value="0">Pasadas</option>
            </select>
        </div>
        <div class="col">
            <button type="submit" class="border border-gray-400 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2">Filtrar</button>
        </div>
    </div>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Id</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Estado</th>
            <th>Servicio</th>
            <th>Usuario</th>
            <th>Accion</th>
        </tr>
    </thead>
    <tbody>
        @foreach($crudcitas as $crudcita)
        <tr>
            <td>{{ $crudcita->id }}</td>
            <td>{{ $crudcita->fecha }}</td>
            <td>{{ $crudcita->hora }}</td>
            <td>{{ $crudcita->estado }}</td>
            <td>{{ $crudcita->service->name ?? 'N/A' }}</td>
            <td>{{ $crudcita->usuario->name ?? 'N/A' }}</td>
            <td>
                <div class="d-flex gap-2">
                    <a href="{{ route('crudcitas.show', [$crudcita->id]) }}" class="btn btn-success">Ver</a>
                    @if($crudcita->estado != 0)
                    <a href="{{ route('crudcitas.edit', [$crudcita->id]) }}" class="btn btn-primary">Editar</a>
                    <a href="{{ route('crudcitas.destroy', [$crudcita->id]) }}" class="btn btn-danger"
                        onclick="event.preventDefault(); if(confirm('¿Estás seguro de que deseas eliminar esta cita?')) { document.getElementById('delete-form-{{$crudcita->id}}').submit();}">
                        Eliminar
                    </a>
                    @endif
                    <form id="delete-form-{{$crudcita->id}}" action="{{ route('crudcitas.destroy', [$crudcita->id]) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<form id="update-citas-form" action="{{ route('citas.update-status') }}" method="POST">
    @csrf
    <button type="submit">Actualizar Estado de las Citas</button>
</form>



<!-- Espacio para mostrar el mensaje de éxito -->
<div id="success-message" style="display: none;" class="alert alert-success" role="alert"></div>


{{-- Botón para volver a la página anterior --}}
<a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Volver</a>



<script src="{{ asset('js/crudCitas.js') }}"></script> <!-- Incluye crudCitas.js al final del contenido -->


@stop
