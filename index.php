<?php
require_once 'controllers/FilmController.php';

// Instanciamos el controlador
$controller = new FilmController();

// Si viene una acción "details" y un id, devolvemos JSON (petición AJAX)
if (isset($_GET['action']) && $_GET['action'] === 'details' && isset($_GET['id'])) {
    $filmId = (int)$_GET['id'];
    $details = $controller->filmDetails($filmId);

    // Devolvemos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($details);
    exit;
}

// Si no es petición AJAX, mostramos la página principal
$films = $controller->listFilms();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8' />
    <title>Films</title>
    <link rel='stylesheet' href='css/home.css' />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<body>
    <?php include('views/home.php')?>
    <script src='http://code.jquery.com/jquery-3.1.0.min.js'></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="js/home.js"></script>
</body>
</html>