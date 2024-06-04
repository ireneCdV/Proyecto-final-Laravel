@extends('default')

@section('content')

<link href="{{ asset('css/styles.css') }}" rel="stylesheet">

@if($errors->any())
<div class="alert alert-danger">
	@foreach ($errors->all() as $error)
	{{ $error }} <br>
	@endforeach
</div>
@endif

{{ Form::model($crudcita, array('route' => array('crudcitas.update', $crudcita->id), 'method' => 'PUT')) }}

<div class="mb-3">
	{{ Form::label('user_name', 'Usuario', ['class'=>'form-label']) }}
	{{ Form::text('user_name', $crudcita->usuario->name, ['class' => 'form-control', 'readonly']) }}
</div>

<div class="mb-3">
	{{ Form::label('servicio_id', 'Servicio', ['class'=>'form-label']) }}
	{{ Form::select('servicio_id', $services->pluck('name', 'id'), $crudcita->servicio_id, ['class' => 'form-control']) }}
</div>

<div class="mb-3">
	{{ Form::label('fecha', 'Fecha', ['class'=>'form-label']) }}
	{{ Form::date('fecha', $crudcita->fecha, array('class' => 'form-control', 'id' => 'fecha')) }}
</div>
<div class="mb-3">
	{{ Form::label('hora', 'Hora', ['class'=>'form-label']) }}
	{{ Form::select('hora', [], null, ['class' => 'form-control', 'id' => 'hora']) }}
</div>

{{ Form::submit('Editar', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

{{-- Botón para volver a la página anterior --}}
<a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Volver</a>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#fecha').change(function() {
        var fecha = $(this).val();
        
        $.ajax({
            url: '{{ route("available-hours") }}',
            type: 'GET',
            data: {
                fecha: fecha,
                cita_id: {{ $crudcita->id }}
            },
            success: function(response) {
                var timeSelect = $('#hora');
                timeSelect.empty();
                timeSelect.append('<option value="">Seleccione una hora</option>');

                var allHours = response.availableHours.concat(response.takenHours);
                allHours.sort();

                allHours.forEach(function(hour) {
                    if (response.takenHours.includes(hour)) {
                        timeSelect.append('<option disabled style="color: red;">' + hour + ' (ocupado)</option>');
                    } else {
                        timeSelect.append('<option value="' + hour + '">' + hour + '</option>');
                    }
                });
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });

    // Cargar las horas disponibles al cargar la página
    $('#fecha').trigger('change');
});
</script>

@stop
