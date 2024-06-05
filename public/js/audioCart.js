function playSoundAndSubmit() {
    var audio = new Audio('sounds/sound-effect-dinero.mp3'); 
    audio.play();
    audio.onended = function() {
        document.getElementById('checkoutForm').submit();
    };
}