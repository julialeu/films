import { showModal, updateModalContent } from './modal.js';
import { fetchFilmDetails } from './ajax.js';

export function bindFilmItemClicks() {
    $('.film-item').on('click', function(e) {
        e.preventDefault();
        
        // Prevent opening the modal if it's already open
        if ($('#filmModal').hasClass('in')) return;
        
        const filmId = $(this).data('id');
        showModal();
        
        fetchFilmDetails(filmId)
            .done(response => {
                if (response.error) {
                    $('#modal-film-details').html(`<p>${response.error}</p>`);
                    return;
                }
                updateModalContent(response);
            })
            .fail(() => {
                $('#modal-film-details').html('<p>Error cargando los detalles.</p>');
            });
    });
}