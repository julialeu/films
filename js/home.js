$(document).ready(function() {
    // Al hacer clic en un elemento de la lista:
    $('.film-item').on('click', function() {
        var filmId = $(this).data('id');

        $.ajax({
            url: 'index.php',
            method: 'GET',
            data: {
                action: 'details',
                id: filmId
            },
            dataType: 'json',
            success: function(response) {
                if (response) {
                    var html = '';
                    html += '<h2>' + response.title + '</h2>';
                    html += '<p><strong>Rating:</strong> ' + response.rating + '</p>';
                    html += '<p><strong>Year:</strong> ' + response.year + '</p>';
                    if (response.image_url) {
                        html += '<img src="' + response.image_url + '" class="img-responsive" style="max-width:300px;" alt="' + response.title + '" />';
                    }
                    $('#film-details').html(html);
                } else {
                    $('#film-details').html('<p>No se encontraron detalles.</p>');
                }
            },
            error: function() {
                $('#film-details').html('<p>Error cargando los detalles.</p>');
            }
        });
    });
});
