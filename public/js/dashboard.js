window.onload = function() {
    if (!auth().user().cod_admin) {
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
        document.getElementById('contador-visitas').textContent = 'Has visitado nuestra página ' + localStorage.getItem('visitas') + ' veces, gracias!!';
    }
};
