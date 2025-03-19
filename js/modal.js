export function showModal() {
    $('#filmModal').modal('show');
}

export function updateModalContent(film) {
    const detailsHtml = `
        <h3>${film.title}</h3>
        <p><strong>Rating:</strong> ${film.rating}</p>
        <p><strong>Year:</strong> ${film.year}</p>
    `;
    $('#modal-film-details').html(detailsHtml);

    if (film.image_url) {
        loadImageWithSpinner(film.image_url);
    }
}

export function loadImageWithSpinner(imageUrl) {
    $('#modal-film-details').append(`
        <div id="image-spinner" class="text-center">
            <span class="glyphicon glyphicon-refresh spin"></span>
        </div>
    `);

    const img = new Image();
    img.onload = function() {
        $('#image-spinner').remove();
        $(img).addClass('img-responsive')
              .css({ 'max-width': '300px', 'margin': 'auto', 'display': 'block' });
        $('#modal-film-details').append(img);
    };
    img.onerror = function() {
        $('#image-spinner').remove();
        $('#modal-film-details').append('<p>Error al cargar la imagen.</p>');
    };
    img.src = imageUrl;
}