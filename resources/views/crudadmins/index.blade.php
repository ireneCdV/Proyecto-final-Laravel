@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('crudadmins.create') }}" class="btn btn-info">Nuevo Admin</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>Nombre</th>
				<th>Apellidos</th>
				<th>Telefono</th>
				<th>Direccion</th>
				<th>DNI</th>
				<th>Email</th>
				{{-- <th>password</th> --}}
				<th>Cod_admin</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($crudadmins as $crudadmin)

				<tr>
					<td>{{ $crudadmin->id }}</td>
					<td>{{ $crudadmin->name }}</td>
					<td>{{ $crudadmin->surname }}</td>
					<td>{{ $crudadmin->phone }}</td>
					<td>{{ $crudadmin->address }}</td>
					<td>{{ $crudadmin->dni }}</td>
					<td>{{ $crudadmin->email }}</td>
					{{-- <td>{{ $crudadmin->password }}</td> --}}
					<td>{{ $crudadmin->cod_admin }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('crudadmins.show', [$crudadmin->id]) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('crudadmins.edit', [$crudadmin->id]) }}" class="btn btn-primary">Modificar</a>
                            <a href="{{ route('crudadmins.destroy', [$crudadmin->id]) }}" class="btn btn-danger"
								onclick="event.preventDefault(); if(confirm('¿Estás seguro de que deseas eliminar este administrador?')) { document.getElementById('delete-form-{{$crudadmin->id}}').submit();}">
								Eliminar
							</a>
							
							<form id="delete-form-{{$crudadmin->id}}" action="{{ route('crudcitas.destroy', [$crudadmin->id]) }}" method="POST" style="display: none;">
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
