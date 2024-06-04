<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Inicio') }}
        </h2>
    </x-slot>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 style="text-align: center">Bienvenid@s</h1>
                    <br>

                    @if (!auth()->user()->es_admin)
                        {{-- CONTADOR DE VISITAS --}}
                        <div id="contador-visitas"></div>
                        <br>
                    @endif
                    
                    <img src="imagenes/slider4.jpg" alt="Imagen 4" class=" border-gold">
                    <br>
                    <p>
                        Tienda online de Productos de Peluquería y Estética

                        En TUPELUQUERIAONLINE intentamos ofrecer el mejor servicio y una relación calidad/precio
                        excepcional; contamos con los precios más competitivos del mercado. Puede encontrar en nuestro
                        catálogo una gran variedad de productos de primera calidad totalmente originales y
                        suminiestrados por el proveedor oficial. Si necesita planchas, secadores, máquinas de corte,
                        utensilios de peluqueria y todo lo relacionado a este sector; somos los indicados para ofrecerle
                        productos profesionales.

                        Nuestra tienda online es fácil, intuitiva, rápida y sobre todo segura. ¡Cuenta con
                        TUPELUQUERIAONLINE para llenar tu salón con productos de peluquería al mejor precio!

                        Si tiene dudas, consultas o simplemente busca asesoramiento profesional, no dude en contactarnos
                        via email , whatsapp o llamarnos a nuestro teléfono gratuito: 951 204 547
                    </p>
                    <br>
                    
                    @if (!auth()->user()->cod_admin)
                        <!-- Sección de Productos Destacados -->
                        <h2 class="text-3xl font-bold text-gray-800 mb-6 justify-center">Productos Destacados</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8 justify-center ">
                            <!-- Producto 1 -->
                            <div class="bg-white rounded-lg shadow-md overflow-hidden border-gold">
                                <img src="{{ asset('storage/images/champutimotei.jpg') }}" alt="Champu" class="w-full h-96 object-cover rounded-t-lg">
                                <div class="p-4">
                                    <h3 class="text-xl font-semibold mb-2">Champú</h3>
                                    <p class="text-gray-600 mb-2">Champú específico para el pelo rizado.</p>
                                    <p class="text-gray-600 mb-2">Precio: 8.50€</p>
                                </div>
                            </div>
                            <!-- Producto 2 -->
                            <div class="bg-white rounded-lg shadow-md overflow-hidden border-gold">
                                <img src="{{ asset('storage/images/cremapantene.jpg') }}" alt="Crema" class="w-full h-96 object-cover rounded-t-lg">
                                <div class="p-4">
                                    <h3 class="text-xl font-semibold mb-2">Crema</h3>
                                    <p class="text-gray-600 mb-2">Curly Crema de Peinado para Rizos.</p>
                                    <p class="text-gray-600 mb-2">Precio: 12.99€ </p>
                                </div>
                            </div>
                            <!-- Producto 3 -->
                            <div class="bg-white rounded-lg shadow-md overflow-hidden border-gold">
                                <img src="{{ asset('storage/images/peinedenman.jpg') }}" alt="Peine" class="w-full h-96 object-cover rounded-t-lg">
                                <div class="p-4">
                                    <h3 class="text-xl font-semibold mb-2">Peine</h3>
                                    <p class="text-gray-600 mb-2">Peine especial para definir rizos.</p>
                                    <p class="text-gray-600 mb-2">Precio: 16.50€</p>
                                </div>
                            </div>

                            <!-- Producto 3 -->
                            <div class="bg-white rounded-lg shadow-md overflow-hidden border-gold">
                                <img src="{{ asset('storage/images/spraybabaria.jpg') }}" alt="Peine" class="w-full h-96 object-cover rounded-t-lg">
                                <div class="p-4">
                                    <h3 class="text-xl font-semibold mb-2">Protector</h3>
                                    <p class="text-gray-600 mb-2">Spray Protector Solar Pieles Sensibles..</p>
                                    <p class="text-gray-600 mb-2">Precio: 9.99€</p>
                                </div>
                            </div>
                        </div>
                        <!-- Botón para ver más productos -->
                        <div class="text-center mt-8">
                            <a href="{{ route('products.list') }}" class="metal-silver border-silver">
                                Ver más productos
                            </a>
                        </div>
                        <br>
                    @endif
                    <br>
                    <br>
                    <video controls>
                        <source src="{{ asset('videos/Video Estilo & Tijeras-1.mp4') }}" type="video/mp4">
                        Tu navegador no soporta video.
                    </video>
                    {{-- <img src="imagenes/proceso_venta2.jpg" alt="Proceso de venta" class=" border-gold" style="width: 100%"> --}}
                    <br>
                    <br>
                    <h2>Preguntas frecuentes</h2>
                    <p>
                        ¿Por qué los precios de TU PELUQUERÍA ONLINE son tan baratos?
                        Esta es una cuestión que nos preguntáis constantemente porque nuestros precios son muy
                        competitivos, la razón es que compramos grandes cantidades y los precios son más económicos; de
                        esta manera podemos ofrecer productos de peluquería y estética baratos, ya sea por unidad o por
                        grupo de artículos. Todos los pedidos que salen de nuestros almacenes se comprueban para que
                        lleguen al cliente en las mejores condiciones posibles.
                    </p>
                    <br>
                    <p>
                        ¿Por qué comprar productos de peluquería o estética en TU PELUQUERÍA ONLINE?
                        Por que tenemos un servicio rápido, efectivo y a unos precios competitivos. Todos los productos
                        son comprados directamente al proveedor oficial de cada marca. Todos los productos son
                        originales y nuevos. Si un cliente recibe un producto en mal estado o dañado, deberá ponerse en
                        contacto con nosotros para buscar una solución en la mayor brevedad posible.
                    </p>
                    <br>
                    <p>
                        ¿En cuánto tiempo se realiza la entrega?
                        Siempre que el pedido se realice antes de las 14:00 le llegará entre 1 y 3 días laborales en la
                        península. Si el pedido se demora nos pondremos en contacto con antelación para ver si hay
                        alguna incidencia con el pedido en cuestión. En este vídeo explicativo puedes consultar nuestra
                        Política de Entrega.
                    </p>
                </div>
                <br>
                <img src="imagenes/inicio1.jpg" alt="Inicio1">
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            @if (!auth()->user()->cod_admin)
                // Verificar si ya existe el contador en LocalStorage
                if (localStorage.getItem('visitas')) {
                    // Obtener el valor actual del contador de visitas desde LocalStorage
                    var visitas = parseInt(localStorage.getItem('visitas'));
                    // Incrementar el contador de visitas
                    visitas++;
                    // Guardar el nuevo valor del contador en LocalStorage
                    localStorage.setItem('visitas', visitas);
                } else {
                    // Si no existe, establecer el contador en 1 y guardarlo en LocalStorage
                    localStorage.setItem('visitas', 1);
                }
                // Mostrar el contador de visitas en el elemento con ID "contador-visitas"
                $('#contador-visitas').text('Has visitado nuestra pagina ' + localStorage.getItem('visitas') + ' veces, gracias!!');
            @endif
        });
    </script>
</x-app-layout>



