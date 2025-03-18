<?php
require_once __DIR__ . '/../models/Film.php';

class FilmController {
    private $film;

    public function __construct() {
        // Configuración para la conexión a la base de datos.
        $dbHost = 'localhost';
        $dbName = 'films';
        $dbUser = 'root';
        $dbPass = '';

        // Se intenta crear la instancia del modelo y capturar cualquier excepción.
        try {
            $this->film = new Film($dbHost, $dbName, $dbUser, $dbPass);
        } catch (Exception $e) {
            error_log("Error while creating Film: " . $e->getMessage());
            die("Error while creating Film: " . $e->getMessage());
        }
    }

    // Método para obtener el listado de películas
    public function listFilms() {
        try {
            return $this->film->getAllFilms();
        } catch (Exception $e) {
            error_log("Error al obtener el listado de películas: " . $e->getMessage());
            return []; // Retorna un array vacío en caso de error
        }
    }

    // Método para obtener los detalles de la película
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