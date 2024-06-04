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
                    <!-- Las horas disponibles se cargarán aquí -->
                </select>
            </div>
            {{ Form::submit('Actualizar', array('class' => 'button-gold mt-3')) }}

        {{ Form::close() }}
    <br>
        <a href="{{ url()->previous() }}" class="metal-silver mt-3">Volver</a>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const availableHoursUrl = "{{ route('available-hours') }}";
    const citaId = "{{ $cita->id }}";
</script>
<script src="{{ asset('js/citas.js') }}"></script>
@endsection
