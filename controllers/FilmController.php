<?php
require_once __DIR__ . '/../models/Film.php';

class FilmController {
    private $film;

    public function __construct() {
        // Database connection parameters
        $dbHost = 'localhost';
        $dbName = 'films';
        $dbUser = 'root';
        $dbPass = '';

        // Attempt to create the Film object
        try {
            $this->film = new Film($dbHost, $dbName, $dbUser, $dbPass);
        } catch (Exception $e) {
            error_log("Error while creating Film: " . $e->getMessage());
            die("Error while creating Film: " . $e->getMessage());
        }
    }

    // Method to get the list of films
    public function listFilms() {
        try {
            return $this->film->getAllFilms();
        } catch (Exception $e) {
            error_log("Error al obtener el listado de películas: " . $e->getMessage());
            return []; // Empty array in case of error
        }
    }

    // Method to get film details
    public function filmDetails($id) {
        try {
            // Verify that $id is an integer to prevent SQL injection
            $id = intval($id);
            return $this->film->getFilmDetails($id);
        } catch (Exception $e) {
            error_log("Error while getting film details: " . $e->getMessage());
            return null;
        }
    }
}
?>