@extends('default')

@section('styles') <!-- Inicio de la sección de estilos -->
<link rel="stylesheet" href="{{ asset('css/citas.css') }}">
@endsection


@section('content')

<div class="container">
    
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" style="text-align: center">
            {{ __('Solicitar cita') }}
        </h2>
    

    <!-- Mostrar mensajes de error si los hay -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    <form method="POST" action="{{ route('citas.store') }}">
        @csrf
    <!-- Sección de servicios -->
    <h5>Servicios</h5>
    <div class="row">
        @foreach($services as $service)
        <div class="col-md-4 mb-3">
            <div class="card service-background">
                <div class="card-body">
                    <h5 class="card-title">{{ $service->name }}</h5>
                    <p class="card-text">Precio: {{ $service->price }}€</p>
                    <input type="radio" name="servicio_id" value="{{ $service->id }}">
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Calendario -->
    {{-- <h2>Calendario</h2> --}}
    
        <div class="form-group">
            <label for="date">Selecciona la fecha:</label>
            <input type="date" class="form-control" id="date" name="fecha">
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
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>


@endsection
{{-- <!-- Agregar enlace al archivo CSS -->
@section('styles')
<link rel="stylesheet" href="{{ asset('css/citas.css') }}">
@endsection --}}

