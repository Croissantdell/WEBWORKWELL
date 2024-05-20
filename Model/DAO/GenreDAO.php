<?php

namespace Model\DAO;

use Model\BO\GenreBO;
use \PDO;

class GenreDAO {
    private $bdd;

    public function __construct(PDO $bdd) {
        $this->bdd = $bdd;
    }

    public function getAllGenres() {
        $query = "SELECT * FROM genre";
        $stmt = $this->bdd->query($query);
        $resultSet = [];
        if ($stmt) {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($stmt as $row) {
                $resultSet[] = new GenreBO($row['idGenre'], $row['libelleGenre']);
            }
        }
        return $resultSet;
    }


    public function findGenre(int $idGenre) {
        $query = "SELECT * FROM genre WHERE idGenre = :idGenre";
        $stmt = $this->bdd->prepare($query);
        $stmt->execute([':idGenre' => $idGenre]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new GenreBO(
            $row['idGenre'],
            $row['libelleGenre']
        ) : null;
    }

    public function getGenresByOeuvre($codeOeuvre) {
        $query = "SELECT g.* FROM genre g
                  JOIN oeuvre o ON g.idGenre = o.idGenre
                  WHERE o.codeOeuvre = :codeOeuvre";
        $stmt = $this->bdd->prepare($query);
        $stmt->execute([':codeOeuvre' => $codeOeuvre]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $genres = [];
        foreach ($rows as $row) {
            $genres[] = new GenreBO(
                $row['idGenre'],
                $row['libelleGenre']
            );
        }
        return $genres;
    }

    public function createGenre(GenreBO $entity) {
        $query = "INSERT INTO genre (libelleGenre) VALUES (:libelle)";
        $stmt = $this->bdd->prepare($query);
        $res = $stmt->execute([':libelle' => $entity->getLibelleGenre()]);
        if ($res) {
            $entity->setIdGenre($this->bdd->lastInsertId());
        }
        return $res ? $entity : null;
    }

    public function updateGenre(GenreBO $entity) {
        $query = "UPDATE genre SET libelleGenre = :libelle WHERE idGenre = :id";
        $stmt = $this->bdd->prepare($query);
        $res = $stmt->execute([
            ':libelle' => $entity->getLibelleGenre(),
            ':id' => $entity->getIdGenre()
        ]);
        return $res ? $entity : false;
    }

    public function deleteGenre(int $id) {
        $query = "DELETE FROM genre WHERE idGenre = :id";
        $stmt = $this->bdd->prepare($query);
        return $stmt->execute([':id' => $id]);
    }
}
