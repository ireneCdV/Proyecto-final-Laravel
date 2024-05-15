@extends('default')

@section('content')

<div class="d-flex justify-content-end mb-3"><a href="{{ route('crudcitas.create') }}" class="btn btn-info">Pedir cita</a></div>


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
                <option value="1">Abierta</option>
                <option value="0">Cerrada</option>
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
            <th>Action</th>
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
                    <a href="{{ route('crudcitas.show', [$crudcita->id]) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('crudcitas.edit', [$crudcita->id]) }}" class="btn btn-primary">Editar</a>
                    <a href="{{ route('crudcitas.destroy', [$crudcita->id]) }}" class="btn btn-danger"
                        onclick="event.preventDefault(); if(confirm('¿Estás seguro de que deseas eliminar esta cita?')) { document.getElementById('delete-form-{{$crudcita->id}}').submit();}">
                        Eliminar
                    </a>
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

@stop
