@extends('default')

@section('content')

<div class="container">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" style="text-align: center">
        {{ __('Editar cita') }}
    </h2>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
        </div>
    @endif

    <div class="container">
        {{ Form::model($cita, array('route' => array('citas.update', $cita->id), 'method' => 'PUT')) }}

            <!-- Sección de servicios -->
            <h5>Servicios</h5>
            <div class="row">
                @foreach($services as $service)
                <div class="col-md-4 mb-3">
                    <div class="card bg-dark text-white" style="background-image: url('/imagenes/servicios.jpg'); background-size: cover; height: 200px;">
                        <div class="card-img-overlay d-flex flex-column justify-content-center">
                            <h5 class="card-title" style="font-size: 18px;">{{ $service->name }}</h5>
                            <p class="card-text" style="font-size: 18px;">Precio: {{ $service->price }}€</p>
                            <label style="font-size: 16px;">
                                <input type="radio" name="servicio_id" value="{{ $service->id }}" {{ $cita->servicio_id == $service->id ? 'checked' : '' }}>
                                Seleccionar
                            </label>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="form-group">
                <label for="date">Selecciona la fecha:</label>
                <input type="date" class="form-control w-25" id="date" name="fecha" value="{{ $cita->fecha }}">
            </div>
    
            <!-- Horario -->
            <div class="form-group">
                <label for="time">Selecciona el horario:</label>
                <select class="form-control w-25" id="time" name="hora">
                    <option value="">Seleccione una hora</option>
                    @foreach(['10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30', '17:00', '17:30', '18:00', '18:30', '19:00', '19:30', '20:00', '20:30'] as $time)
                        <option value="{{ $time }}" {{ $cita->hora == $time ? 'selected' : '' }}>{{ $time }}</option>
                    @endforeach
                </select>
            </div>
            {{ Form::submit('Actualizar', array('class' => 'button-gold mt-3')) }}
            <a href="{{ url()->previous() }}" class="metal-silver mt-3">Volver</a>

        {{ Form::close() }}
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        function loadAvailableHours() {
            var selectedDate = $('#date').val();
            var citaId = "{{ $cita->id }}"; // Obtener el ID de la cita actual

            $.ajax({
                url: "{{ route('available-hours') }}",
                method: "GET",
                data: {
                    fecha: selectedDate,
                    cita_id: citaId
                },
                success: function(response) {
                    var timeSelect = $('#time');
                    timeSelect.empty();
                    timeSelect.append('<option value="">Seleccione una hora</option>');

                    var allHours = ['10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30',
                                    '17:00', '17:30', '18:00', '18:30', '19:00', '19:30', '20:00', '20:30'];

                    allHours.forEach(function(hour) {
                        if (response.takenHours.includes(hour)) {
                            if (hour === "{{ $cita->hora }}") {
                                timeSelect.append('<option value="' + hour + '" selected>' + hour + ' (ocupado)</option>');
                            } else {
                                timeSelect.append('<option value="' + hour + '" disabled>' + hour + ' (ocupado)</option>');
                            }
                        } else {
                            timeSelect.append('<option value="' + hour + '">' + hour + '</option>');
                        }
                    });
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

        $('#date').on('change', function() {
            loadAvailableHours();
        });

        // Cargar las horas disponibles al cargar la página
        loadAvailableHours();
    });
</script>

@endsection
