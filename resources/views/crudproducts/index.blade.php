@extends('default')

@section('content')
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('crudproducts.create') }}" class="btn btn-info">Añadir Producto</a></div>

	<div class="mb-4">
        <form method="GET" action="{{ route('crudproducts.index') }}">
            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="orderBy">
                Ordenar por:
            </label>
            <select name="orderBy" id="orderBy"
                class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="" disabled selected>Seleccione una opción</option>
                <option value="asc">Precio más bajo</option>
                <option value="desc">Precio más alto</option>
                <option value="stock_desc">Más stock</option>
                <option value="stock_asc">Menos stock</option>
            </select>
            <button type="submit"
                class="border border-gray-400 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2">Ordenar</button>
        </form>
    </div>

	<table class="table table-bordered" style="text-align: center">
		<thead>
			<tr >
				<th>id</th>
				<th>Imagen</th>
				<th>Nombre</th>
				<th>Descripcion</th>
				<th>Precio</th>
				<th>Stock</th>
				<th>Marca</th>
				<th>Categoria</th>

				<th>Accion</th>
			</tr>
		</thead>
		<tbody>
			@foreach($crudproducts as $crudproduct)

				<tr>
					<td>{{ $crudproduct->id }}</td>
					<td><img src="{{ asset('storage/' . $crudproduct->image) }}" alt="Imagen del producto" style="width: 100px; height: auto;"></td>
					<td>{{ $crudproduct->name }}</td>
					<td>{{ $crudproduct->description }}</td>
					<td>{{ $crudproduct->price }}</td>
					<td>{{ $crudproduct->stock }}</td>
					<td>{{ $crudproduct->brand }}</td>
					<td>{{ $crudproduct->category_id }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('crudproducts.show', [$crudproduct->id]) }}" class="btn btn-success">Ver</a>
                            <a href="{{ route('crudproducts.edit', [$crudproduct->id]) }}" class="btn btn-primary">Editar</a>
                            <a href="{{ route('crudproducts.destroy', [$crudproduct->id]) }}" class="btn btn-danger"
								onclick="event.preventDefault(); if(confirm('¿Estás seguro de que deseas eliminar este propducto?')) { document.getElementById('delete-form-{{$crudproduct->id}}').submit();}">
								Eliminar
							</a>
							<form id="delete-form-{{$crudproduct->id}}" action="{{ route('crudproducts.destroy', [$crudproduct->id]) }}" method="POST" style="display: none;">
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
	<a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Volver</a>

@stop
