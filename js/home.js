$(document).ready(function() {
    // Evento de clic en el icono de información
    $('.film-item').on('click', function(e) {
        e.preventDefault();

        // Evitar múltiples solicitudes si el modal ya está abierto
        if ($('#filmModal').hasClass('in')) return;

        var filmId = $(this).data('id');

        // Mostrar el modal con el spinner
        showModalWithSpinner();

        // Realizar la solicitud AJAX para obtener detalles de la película
        fetchFilmDetails(filmId);
    });
});

/**
 * Muestra el modal con un spinner de carga mientras se obtiene la información.
 */
function showModalWithSpinner() {
    $('#modal-film-details').html(`
        <div id="spinner" class="text-center">
            <span class="glyphicon glyphicon-refresh spin"></span>
            <p>Cargando detalles...</p>
        </div>
    `);
    $('#filmModal').modal('show');
}

/**
 * Obtiene los detalles de la película por AJAX y actualiza el modal.
 * @param {number} filmId - ID de la película a consultar.
 */
function fetchFilmDetails(filmId) {
    $.ajax({
        url: 'index.php',
        method: 'GET',
        data: { action: 'details', id: filmId },
        dataType: 'json',
        success: function(response) {
            if (response.error) {
                $('#modal-film-details').html(`<p>${response.error}</p>`);
                return;
            }
            updateModalContent(response);
        },
        error: function() {
            $('#modal-film-details').html('<p>Error cargando los detalles.</p>');
        }
    });
}

/**
 * Inserta los detalles de la película en el modal.
 * @param {Object} film - Objeto con los datos de la película (title, rating, year, image_url).
 */
function updateModalContent(film) {
    var detailsHtml = `
        <h3>${film.title}</h3>
        <p><strong>Rating:</strong> ${film.rating}</p>
        <p><strong>Year:</strong> ${film.year}</p>
    `;
    $('#modal-film-details').html(detailsHtml);

    if (film.image_url) {
        loadImageWithSpinner(film.image_url);
    }
}

/**
 * Carga la imagen de la película de forma asíncrona y muestra un spinner mientras se carga.
 * @param {string} imageUrl - URL de la imagen de la película.
 */
function loadImageWithSpinner(imageUrl) {
    // Agregar spinner de carga para la imagen
    $('#modal-film-details').append(`
        <div id="image-spinner" class="text-center">
            <span class="glyphicon glyphicon-refresh spin"></span>
        </div>
    `);

    var img = new Image();
    img.onload = function() {
        $('#image-spinner').remove();
        $(img).addClass('img-responsive')
              .css({'max-width':'300px', 'margin':'auto', 'display':'block'});
        $('#modal-film-details').append(img);
    };
    img.onerror = function() {
        $('#image-spinner').remove();
        $('#modal-film-details').append('<p>Error al cargar la imagen.</p>');
    };
    img.src = imageUrl;
}