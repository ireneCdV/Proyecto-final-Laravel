@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('citas.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				{{-- <th>id</th> --}}
				<th>fecha</th>
				<th>hora</th>
				<th>servicio</th>

				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($citas as $cita)

				<tr>
					{{-- <td>{{ $cita->id }}</td> --}}
					<td>{{ $cita->fecha }}</td>
					<td>{{ $cita->hora }}</td>
					<td>{{ $cita->servicio_id }}</td>
					{{-- <td>{{ $cita->servicio->name }}</td> --}}

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('citas.show', [$cita->id]) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('citas.edit', [$cita->id]) }}" class="btn btn-primary">Modificar</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['citas.destroy', $cita->id]]) !!}
                                {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
