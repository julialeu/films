<?php
class Film {
    private $conn;

    public function __construct($dbHost, $dbName, $dbUser, $dbPass) {
        // connection to the database
        $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=utf8";
        $this->conn = new PDO($dsn, $dbUser, $dbPass);
        // handle error
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Get all films from the database
     */
    public function getAllFilms() {
        $stmt = $this->conn->query("SELECT id, title FROM f_film ORDER BY title ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * query to get film details
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
