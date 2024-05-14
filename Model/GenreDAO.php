<?php

require_once '../Database.php';
require_once 'GenreBO.php';


class GenreDAO {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getAllGenres() {
        $sql = 'SELECT * FROM genre';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGenreById($idGenre) {
        $sql = 'SELECT * FROM genre WHERE idGenre = :idGenre';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':idGenre', $idGenre);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getGenresByOeuvre($codeOeuvre): array {
        $sql = "SELECT g.* FROM OEUVRE_GENRE og JOIN GENRE g ON og.idGenre = g.idGenre WHERE og.codeOeuvre = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$codeOeuvre]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function createGenre(GenreBO $genre): bool {
        $sql = "INSERT INTO genre (idGenre, libelleGenre) VALUES (:idGenre, :libelleGenre)";
        $stmt = $this->db->prepare($sql);

        // Assigning the property values to variables
        $idGenre = $genre->getIdGenre();
        $libelleGenre = $genre->getLibelleGenre();

        $stmt->bindParam(':idGenre', $idGenre);
        $stmt->bindParam(':libelleGenre', $libelleGenre);

        return $stmt->execute();
    }
}