<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto</title>
    <script defer src="{{ asset('js/contact.js') }}"></script> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="{{ asset('css/contact/contact.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">



</head>
<body>
    
    @extends('default')
    @section('content')
    
    <header>
        <!-- Aquí puedes colocar la imagen en la cabecera -->
        <img src="{{ asset('imagenes/contacto2.jpg') }}" alt="Imagen de cabecera" width="100%" height="auto">
<br>
        <!-- Título -->
        <h1>Contacta con nosotros siempre que lo necesites</h1>


    </header>

    <div class="container mt-4">
        <div class="row">
            <!-- Tarjeta de Horario -->
            <div class="col-md-6">
                <div class=" custom-bg">
                    <div class="card-body">
                        <h5 class="card-title">Horario de la empresa</h5>
                        <p class="card-text">Lunes a Viernes de 10:00 am a 8:30 pm</p>
                        <p class="card-text">Sabados y domingo: cerrado</p>
                    </div>
                </div>
            </div>

            <!-- Tarjeta de Detalles de Contacto -->
            <div class="col-md-6">
                <div class=" custom-bg">
                    <div class="card-body">
                        <h5 class="card-title">Detalles de contacto</h5>
                        <p class="card-text">
                            <i class="fas fa-phone-alt metal-gold"></i> Teléfono fijo: 900 900 900
                        </p>
                        <p class="card-text">
                            <i class="fas fa-mobile-alt metal-gold"></i> Teléfono móvil: 684 000 000
                        </p>
                        <p class="card-text">
                            <i class="fas fa-envelope metal-gold"></i> Email: estiloytijeras@gmail.com
                        </p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
<br>
<br>

<h2>Formulario de contacto</h2>
    <section id="contacto" class="formulario">
        
        <form id="contactForm" method="POST" action="{{ route('contact.submit') }}" onsubmit="saveContactFormData()">
            @csrf
            <label for="">Los campos con * son obligatorios</label>
            <!-- Campo de Email -->
            <input type="email" id="email" name="email" placeholder="Tu correo electrónico *" value="{{ auth()->user()->email }}" required size="40"><br>

            <br>
            
            <input type="text" id="subject" name="subject" placeholder="Asunto *" required size="40"><br>
            
            <br>
            <textarea id="message" name="message" placeholder="Mensaje *" required rows="4" cols="40"></textarea><br>
                            
            <button class="metal-silver" type="submit">Enviar</button>
        </form>
    </section>
    
    

    @stop
</body>
</html>
