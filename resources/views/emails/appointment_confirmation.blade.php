{{-- <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recordatorio de Cita</title>
</head>
<body>
    <p>Hola {{ $cita->user->name }},</p>
    
    <p>Este es un recordatorio de tu cita programada para:</p>
    
    <ul>
        <li><strong>Fecha:</strong> {{ $cita->fecha }}</li>
        <li><strong>Hora:</strong> {{ $cita->hora }}</li>
        <!-- Puedes agregar más detalles de la cita aquí según tus necesidades -->
    </ul>
    
    <p>Por favor, asegúrate de estar disponible a tiempo para tu cita.</p>
    
    <p>Gracias,<br>
    Tu Salón de Belleza</p>
</body>
</html>
 --}}


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
 
