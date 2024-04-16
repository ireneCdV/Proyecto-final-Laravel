/* Buscador por nombre de productos */
document.getElementById('search').addEventListener('input', function () {
    document.getElementById('filterForm').submit();
});


/* Filtrado de categoria, Se filtra al pulsar la categoria */
document.addEventListener('DOMContentLoaded', function() {
    // Obtener el desplegable de categoría
    var categoryDropdown = document.getElementById('category');

    // Agregar un controlador de eventos de cambio al desplegable
    categoryDropdown.addEventListener('change', function() {
        // Obtener el formulario
        var form = document.getElementById('product-filter-form');
        
        // Enviar el formulario
        form.submit();
    });
});
