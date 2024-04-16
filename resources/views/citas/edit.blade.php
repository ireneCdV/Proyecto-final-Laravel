@extends('default')

@section('content')

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
        </div>
    @endif

    <div class="container">
        <h1>Editar cita</h1>
    
        {{ Form::model($cita, array('route' => array('citas.update', $cita->id), 'method' => 'PUT')) }}

            <!-- Sección de servicios -->
            <h5>Servicios</h5>
            <div class="row">
                @foreach($services as $service)
                    <div class="col-md-4 mb-3">
                        <div class="card service-background">
                            <div class="card-body">
                                <h5 class="card-title">{{ $service->name }}</h5>
                                <p class="card-text">Precio: {{ $service->price }}€</p>
                                <input type="radio" name="servicio_id" value="{{ $service->id }}" {{ $cita->servicio_id == $service->id ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mb-3">
                {{ Form::label('fecha', 'Fecha', ['class'=>'form-label']) }}
                {{ Form::date('fecha', $cita->fecha, array('class' => 'form-control')) }}
            </div>
            <!-- Horario -->
    {{-- <h2>Horario</h2> --}}
        <div class="form-group">
            <label for="time">Selecciona el horario:</label>
            <select class="form-control" id="time" name="hora">
                <option value="10:00">10:00 AM</option>
                <option value="10:30">10:30 AM</option>
                <option value="11:00">11:00 AM</option>
                <option value="11:30">11:30 AM</option>
                <option value="12:00">12:00 AM</option>
                <option value="12:30">12:30 AM</option>
                <option value="13:00">13:00 AM</option>
                <option value="13:30">13:30 AM</option>
                <option value="17:00">17:00 AM</option>
                <option value="17:30">17:30 AM</option>
                <option value="18:00">18:00 AM</option>
                <option value="18:30">18:30 AM</option>
                <option value="19:00">19:00 AM</option>
                <option value="19:30">19:30 AM</option>
                <option value="20:00">20:00 AM</option>
                <option value="20:30">20:30 AM</option>
            </select>
        </div>

            {{ Form::submit('Actualizar', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}
    </div>
@stop
