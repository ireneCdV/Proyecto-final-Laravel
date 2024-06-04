@extends('default')

@section('content')
<script src="{{ asset('js/crudAdmin.js') }}"></script>

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
            {{-- <th>Cod_admin</th> --}}
            <th>Accion</th>
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
			{{-- <td>{{ $crudadmin->cod_admin }}</td> --}}
			<td>
				<div class="d-flex gap-2">
					<a href="{{ route('crudadmins.show', [$crudadmin->id]) }}" class="btn btn-success">Ver</a>
					
					<!-- Verifica si el correo es superadmin@gmail.com -->
					@if($crudadmin->email !== 'superadmin@gmail.com')
						<a href="{{ route('crudadmins.edit', [$crudadmin->id]) }}" class="btn btn-primary">Modificar</a>
						<button class="btn btn-danger" onclick="event.preventDefault(); showDeleteForm({{ $crudadmin->id }});">Eliminar</button>
					@endif
				</div>
				<!-- Formulario de eliminación -->
				<form id="delete-form-{{$crudadmin->id}}" action="{{ route('crudadmins.destroy', [$crudadmin->id]) }}" method="POST" style="display: none;">
					@csrf
					@method('DELETE')
					<div class="form-group">
						<label for="cod_admin">Ingrese su código de administrador para confirmar:</label>
						<input type="password" name="cod_admin" class="form-control" required>
					</div>
					<button type="submit" class="btn btn-danger mt-2">Confirmar eliminación</button>
				</form>
			</td>
		</tr>
	@endforeach
    </tbody>
</table>
<a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Volver</a>


@stop