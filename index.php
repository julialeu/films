<?php
require_once 'controllers/FilmController.php';

// Controller instance
$controller = new FilmController();

// if action is details return film details in json
if (isset($_GET['action']) && $_GET['action'] === 'details' && isset($_GET['id'])) {
    $filmId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    header('Content-Type: application/json');
    if ($filmId === false) {
        echo json_encode(["error" => "ID inválido"]);
        exit;
    }

    $details = $controller->filmDetails($filmId);
    if ($details) {
        echo json_encode($details);
    } else {
        echo json_encode(["error" => "No se encontraron detalles."]);
    }
    exit;
}

// if not action return films
$films = $controller->listFilms();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Films</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/home.css" />
    <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
        crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
        integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp"
        crossorigin="anonymous">
</head>

<body>

    <?php include('views/home.php'); ?>

    <!-- Modal film details -->
    <div class="modal fade" id="filmModal" tabindex="-1" role="dialog" aria-labelledby="filmModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title text-center" id="filmModalLabel">Film details</h4>
                </div>
                <div class="modal-body" id="modal-film-details">
                </div>
            </div>
        </div>
    </div>


    <script src="http://code.jquery.com/jquery-3.1.0.min.js"></script>
    <script
        src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous">
    </script>
    <script type="module" src="js/home.js"></script>
</body>

</html>