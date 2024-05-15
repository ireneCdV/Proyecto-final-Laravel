@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('crudservices.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>name</th>
				<th>price</th>

				<th>Action</th>
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
                            <a href="{{ route('crudservices.show', [$crudservice->id]) }}" class="btn btn-info">Ver</a>
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

@stop
