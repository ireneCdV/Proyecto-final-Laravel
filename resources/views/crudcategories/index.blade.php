@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('crudcategories.create') }}" class="btn btn-info">Añadir categoria</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>title</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($crudcategories as $crudcategory)

				<tr>
					<td>{{ $crudcategory->id }}</td>
					<td>{{ $crudcategory->title }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('crudcategories.show', [$crudcategory->id]) }}" class="btn btn-success">Ver</a>
                            <a href="{{ route('crudcategories.edit', [$crudcategory->id]) }}" class="btn btn-primary">Editar</a>
                            <a href="{{ route('crudcategories.destroy', [$crudcategory->id]) }}" class="btn btn-danger"
								onclick="event.preventDefault(); if(confirm('¿Estás seguro de que deseas eliminar esta categoria?')) { document.getElementById('delete-form-{{$crudcategory->id}}').submit();}">
								Eliminar
							</a>
							<form id="delete-form-{{$crudcategory->id}}" action="{{ route('crudcategories.destroy', [$crudcategory->id]) }}" method="POST" style="display: none;">
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
