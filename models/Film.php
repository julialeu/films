<?php
class Film {
    private $conn;

    public function __construct($dbHost, $dbName, $dbUser, $dbPass) {
        // Conexión con PDO
        $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=utf8";
        $this->conn = new PDO($dsn, $dbUser, $dbPass);
        // Opcionalmente, puedes configurar atributos de PDO para manejo de errores, etc.
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Devuelve todos los films, solo id y título.
     */
    public function getAllFilms() {
        $stmt = $this->conn->query("SELECT id, title FROM f_film ORDER BY title ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Devuelve los detalles de un film, uniendo la tabla de imágenes.
     */
    public function getFilmDetails($id) {
        $sql = "SELECT f_film.id, f_film.title, f_film.rating, f_film.year, f_image.image_url
                FROM f_film
                LEFT JOIN f_image ON f_film.id = f_image.film_fk
                WHERE f_film.id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
