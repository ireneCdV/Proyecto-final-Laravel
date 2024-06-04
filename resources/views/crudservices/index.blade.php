@extends('default')

@section('content')
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('crudservices.create') }}" class="btn btn-info">Nuevo Servicio</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>Nombre</th>
				<th>Precio</th>

				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($crudservices as $crudservice)

				<tr>
					<td>{{ $crudservice->id }}</td>
					<td>{{ $crudservice->name }}</td>
					<td>{{ $crudservice->price }}€</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('crudservices.show', [$crudservice->id]) }}" class="btn btn-success">Ver</a>
                            <a href="{{ route('crudservices.edit', [$crudservice->id]) }}" class="btn btn-primary">Editar</a>
                            <a href="{{ route('crudservices.destroy', [$crudservice->id]) }}" class="btn btn-danger"
								onclick="event.preventDefault(); if(confirm('¿Estás seguro de que deseas eliminar este servicio?')) { document.getElementById('delete-form-{{$crudservice->id}}').submit();}">
								Eliminar
							</a>
							<form id="delete-form-{{$crudservice->id}}" action="{{ route('crudservices.destroy', [$crudservice->id]) }}" method="POST" style="display: none;">
								@csrf
								@method('DELETE')
							</form>
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>
	<a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Volver</a>
@stop
