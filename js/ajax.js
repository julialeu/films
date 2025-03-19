export function fetchFilmDetails(filmId) {
    return $.ajax({
         url: 'index.php',
         method: 'GET',
         data: { action: 'details', id: filmId },
         dataType: 'json'
    });
}