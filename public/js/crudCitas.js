

document.getElementById('update-citas-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita el envío del formulario por defecto

    // Realizar una solicitud AJAX
    fetch(this.action, {
        method: this.method,
        body: new FormData(this)
    })
    .then(response => {
        if (response.ok) {
            return response.json();
        }
        throw new Error('Error en la respuesta del servidor.');
    })
    .then(data => {
        // Mostrar el mensaje de éxito y ocultar el formulario
        document.getElementById('success-message').textContent = data.message;
        document.getElementById('success-message').style.display = 'block';
        document.getElementById('update-citas-form').style.display = 'none';
    })
    .catch(error => {
        console.error('Error:', error);
        // Mostrar un mensaje de error si algo sale mal
        document.getElementById('success-message').textContent = 'Se produjo un error al actualizar el estado de las citas.';
        document.getElementById('success-message').style.display = 'block';
    });
});
