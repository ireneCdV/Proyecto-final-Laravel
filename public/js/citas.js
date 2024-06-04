window.onload = function() {
    // Script para la vista de crear citas
    $('#date').on('change', function() {
        var selectedDate = $(this).val();

        $.ajax({
            url: availableHoursUrl,
            method: "GET",
            data: { fecha: selectedDate },
            success: function(response) {
                var timeSelect = $('#time');
                timeSelect.empty();
                timeSelect.append('<option value="">Seleccione una hora</option>');

                // Combina las horas disponibles y ocupadas en un solo conjunto
                var allHours = response.availableHours.concat(response.takenHours);
                allHours.sort(); // Ordenar las horas para mantener el orden cronológico

                allHours.forEach(function(hour) {
                    if (response.takenHours.includes(hour)) {
                        timeSelect.append('<option disabled style="color: red;">' + hour + ' (ocupado)</option>');
                    } else {
                        timeSelect.append('<option value="' + hour + '">' + hour + '</option>');
                    }
                });
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });

    // Script para la vista de editar citas
    function loadAvailableHours() {
        var selectedDate = $('#date').val();

        $.ajax({
            url: availableHoursUrl,
            method: "GET",
            data: {
                fecha: selectedDate,
                cita_id: citaId
            },
            success: function(response) {
                var timeSelect = $('#time');
                timeSelect.empty();
                timeSelect.append('<option value="">Seleccione una hora</option>');

                var allHours = response.availableHours.concat(response.takenHours);
                allHours.sort();

                allHours.forEach(function(hour) {
                    if (response.takenHours.includes(hour)) {
                        if (hour === citaHora) {
                            timeSelect.append('<option value="' + hour + '" selected>' + hour + '</option>');
                        } else {
                            timeSelect.append('<option disabled style="color: red;">' + hour + ' (ocupado)</option>');
                        }
                    } else {
                        timeSelect.append('<option value="' + hour + '">' + hour + '</option>');
                    }
                });
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }

    $('#date').on('change', function() {
        loadAvailableHours();
    });

    // Cargar las horas disponibles al cargar la página
    loadAvailableHours();
};



window.onload = function() {
    // JavaScript para activar el desplazamiento automático cada 5 segundos
    $('#carouselExampleControls').carousel();
};
