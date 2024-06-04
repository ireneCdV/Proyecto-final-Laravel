window.onload = function() {
    const products = JSON.parse(document.getElementById('products-data').textContent);

    // Función para mostrar sugerencias de búsqueda
    document.getElementById('search').addEventListener('input', function() {
        let query = this.value.toLowerCase();

        if (query.length > 3) {
            let filteredProducts = products.filter(product => product.name.toLowerCase().includes(query));
            
            let suggestions = document.getElementById('suggestions');
            suggestions.innerHTML = '';

            filteredProducts.forEach(product => {
                let suggestionItem = document.createElement('div');
                suggestionItem.textContent = product.name;
                suggestionItem.classList.add('suggestion-item');

                suggestions.appendChild(suggestionItem);
            });
        } else {
            document.getElementById('suggestions').innerHTML = '';
        }
    });

    // Función para alternar el estado de favorito de un producto
    function toggleFavorito(productoId) {
        let favoritos = JSON.parse(localStorage.getItem('favoritos')) || [];

        if (favoritos.includes(productoId)) {
            favoritos = favoritos.filter(id => id !== productoId);
        } else {
            favoritos.push(productoId);
        }

        localStorage.setItem('favoritos', JSON.stringify(favoritos));
        actualizarIconoFavorito(productoId);
    }

    // Función para actualizar el icono de favorito según el estado
    function actualizarIconoFavorito(productoId) {
        let favoritos = JSON.parse(localStorage.getItem('favoritos')) || [];
        let icono = document.getElementById(`icono-${productoId}`);

        if (favoritos.includes(productoId)) {
            icono.textContent = '\u2764'; // ❤️
            icono.classList.remove('desmarcado');
            icono.classList.add('marcado');
        } else {
            icono.textContent = '🤍';
            icono.classList.remove('marcado');
            icono.classList.add('desmarcado');
        }
    }

    // Función para inicializar el estado de los iconos de favoritos al cargar la página
    function inicializarFavoritos() {
        let favoritos = JSON.parse(localStorage.getItem('favoritos')) || [];
        favoritos.forEach(productoId => {
            actualizarIconoFavorito(productoId);
        });
    }

    // Ejecutar la función de inicialización al cargar la página
    inicializarFavoritos();

    window.toggleFavorito = toggleFavorito;
};
