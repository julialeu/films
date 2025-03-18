<?php
require_once __DIR__ . '/../models/Film.php';

class FilmController {
    private $film;

    public function __construct() {
        // Ajusta estos valores de conexión a tu entorno
        $dbHost = 'localhost';
        $dbName = 'films';
        $dbUser = 'root';
        $dbPass = '';

        $this->film = new Film($dbHost, $dbName, $dbUser, $dbPass);
    }

    public function listFilms() {
        return $this->film->getAllFilms();
    }

    public function filmDetails($id) {
        return $this->film->getFilmDetails($id);
    }
}