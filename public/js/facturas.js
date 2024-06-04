window.onload = function() {
    document.querySelectorAll('.mostrar-detalles-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const detallesFactura = btn.parentNode.querySelector('.detalles-factura');
            if (detallesFactura.style.display === 'none' || detallesFactura.style.display === '') {
                detallesFactura.style.display = 'block';
            } else {
                detallesFactura.style.display = 'none';
            }
        });
    });
};