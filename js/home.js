$(document).ready(function() {
    $('.film-item').on('click', function(e) {
        e.preventDefault();

        // Verificar si el modal ya está abierto
        if ($('#filmModal').hasClass('in')) {
            // Si el modal está abierto, no se hace nada
            return;
        }

        var filmId = $(this).data('id');

        // Petición AJAX para obtener los detalles de la película
        $.ajax({
            url: 'index.php',
            method: 'GET',
            data: {
                action: 'details',
                id: filmId
            },
            dataType: 'json',
            beforeSend: function() {
                // Antes de recibir la respuesta del servidor,
                // limpiamos el contenido anterior y mostramos el spinner.
                $('#modal-film-details').html(`
                    <div id="spinner" class="text-center">
                        <span class="glyphicon glyphicon-refresh spin"></span>
                        <p>Cargando detalles...</p>
                    </div>
                `);
                // Mostramos el modal de inmediato para que el usuario vea el spinner.
                $('#filmModal').modal('show');
            },
            success: function(response) {
                // Limpiamos el contenido para insertar los nuevos detalles.
                $('#modal-film-details').html('');

                if (response.error) {
                    // Si hubo error en la respuesta (p.e. ID inválido o no se encontraron detalles)
                    $('#modal-film-details').html('<p>' + response.error + '</p>');
                    return;
                }

                // Construimos el HTML del texto (título, rating, etc.)
                var detailsHtml = `
                    <h3>${response.title}</h3>
                    <p><strong>Rating:</strong> ${response.rating}</p>
                    <p><strong>Year:</strong> ${response.year}</p>
                `;
                // Insertamos primero el texto
                $('#modal-film-details').append(detailsHtml);

                // Si existe una URL de imagen, la cargamos con un spinner mientras se descarga
                if (response.image_url) {
                    // Agregamos un nuevo spinner específico para la imagen
                    $('#modal-film-details').append(`
                        <div id="image-spinner" class="text-center">
                            <span class="glyphicon glyphicon-refresh spin"></span>
                        </div>
                    `);
                    // Creamos un objeto Image para cargar la imagen de forma asíncrona
                    var img = new Image();
                    img.onload = function() {
                        // Cuando la imagen haya cargado, removemos el spinner
                        $('#image-spinner').remove();
                        // Agregamos la imagen al modal
                        $(img).addClass('img-responsive')
                              .css({'max-width':'300px','margin':'auto','display':'block'});
                        $('#modal-film-details').append(img);
                    };
                    // Si la imagen falla al cargar
                    img.onerror = function() {
                        $('#image-spinner').remove();
                        $('#modal-film-details').append('<p>Error al cargar la imagen.</p>');
                    };
                    // Iniciamos la carga
                    img.src = response.image_url;
                }
            },
            error: function() {
                // Si falla la petición AJAX
                $('#modal-film-details').html('<p>Error cargando los detalles.</p>');
                $('#filmModal').modal('show');
            }
        });
    });
});
