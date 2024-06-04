function playSoundAndSubmit() {
    var audio = new Audio('sounds/sound-effect-dinero.mp3'); // Cambia la ruta al archivo de sonido
    audio.play();
    audio.onended = function() {
        document.getElementById('checkoutForm').submit();
    };
}