<!DOCTYPE html>
<html>
<head>
    <title>Confirmación de Cita</title>
</head>
<body>
    <h1>Confirmación de tu Cita</h1>
    <p>Hola, {{ $cita->usuario->name }}!</p>
    <p>Tu cita para el servicio {{ $cita->service->nombre }} está programada para el {{ $cita->fecha }} a las {{ $cita->hora }}.</p>
    <p>Gracias por elegir nuestros servicios.</p>
</body>
</html>
 
