<?php

namespace Model\DAO;

use Model\BO\RealisateurBO;
use PDO;
use Model\BO\OeuvreBO;

class RealisateurDAO {
    private $bdd;

    public function __construct(PDO $bdd) {
        $this->bdd = $bdd;
    }

    public function getAllRealisateurs() {
        $query = "SELECT * FROM realisateur";
        $stmt = $this->bdd->query($query);
        $resultSet = [];
        if ($stmt) {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($stmt as $row) {
                $resultSet[] = new RealisateurBO(
                    $row['idRealisateur'],
                    $row['nomRealisateur'],
                    $row['prenomRealisateur'],
                    $row['nationaliteRealisateur'],
                    $row['recompenseRealisateur'],
                    $row['photo']
                );
            }
        }
        return $resultSet;
    }

    public function findRealisateur(int $id) {
        $query = "SELECT * FROM realisateur WHERE idRealisateur = :id";
        $stmt = $this->bdd->prepare($query);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new RealisateurBO(
            $row['idRealisateur'],
            $row['nomRealisateur'],
            $row['prenomRealisateur'],
            $row['nationaliteRealisateur'],
            $row['recompenseRealisateur'],
            $row['photo']
        ) : null;
    }

    public function createRealisateur(RealisateurBO $entity) {
        $query = "INSERT INTO realisateur (nomRealisateur, prenomRealisateur, nationaliteRealisateur, recompenseRealisateur, photo) VALUES (:nom, :prenom, :nationalite, :recompense, :photo)";
        $stmt = $this->bdd->prepare($query);
        $res = $stmt->execute([
            ':nom' => $entity->getNomRealisateur(),
            ':prenom' => $entity->getPrenomRealisateur(),
            ':nationalite' => $entity->getNationaliteRealisateur(),
            ':recompense' => $entity->getRecompenseRealisateur(),
            ':photo' => $entity->getPhoto()
        ]);
        if ($res) {
            $entity->setIdRealisateur($this->bdd->lastInsertId());
        }
        return $res ? $entity : null;
    }

    public function updateRealisateur(RealisateurBO $entity) {
        $query = "UPDATE realisateur SET nomRealisateur = :nom, prenomRealisateur = :prenom, nationaliteRealisateur = :nationalite, recompenseRealisateur = :recompense, photo = :photo WHERE idRealisateur = :id";
        $stmt = $this->bdd->prepare($query);
        $res = $stmt->execute([
            ':nom' => $entity->getNomRealisateur(),
            ':prenom' => $entity->getPrenomRealisateur(),
            ':nationalite' => $entity->getNationaliteRealisateur(),
            ':recompense' => $entity->getRecompenseRealisateur(),
            ':photo' => $entity->getPhoto(),
            ':id' => $entity->getIdRealisateur()
        ]);
        return $res ? $entity : false;
    }

    public function deleteRealisateur(int $id) {
        $query = "DELETE FROM realisateur WHERE idRealisateur = :id";
        $stmt = $this->bdd->prepare($query);
        return $stmt->execute([':id' => $id]);
    }

    public function getOeuvresByRealisateur(int $id) {
        $query = "SELECT o.* FROM oeuvre o INNER JOIN realiser r ON o.codeOeuvre = r.codeOeuvre WHERE r.idRealisateur = :id";
        $stmt = $this->bdd->prepare($query);
        $stmt->execute([':id' => $id]);
        $resultSet = [];
        if ($stmt) {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($stmt as $row) {
                $resultSet[] = new OeuvreBO(
                    $row['codeOeuvre'],
                    $row['titreOriginalOeuvre'],
                    $row['titreFrancaisOeuvre'],
                    $row['anneeSortieOeuvre'],
                    $row['resumeOeuvre'],
                    $row['nbEpisodeOeuvre'],
                    $row['affiche'],
                    $row['codeClassification'],
                    $row['idGenre']
                );
            }
        }
        return $resultSet;
    }
    public function getRealisateurByOeuvre($codeOeuvre) {
        $query = "SELECT r.* FROM realiser re
                  JOIN realisateur r ON re.idRealisateur = r.idRealisateur
                  WHERE re.codeOeuvre = :codeOeuvre";
        $stmt = $this->bdd->prepare($query);
        $stmt->execute([':codeOeuvre' => $codeOeuvre]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new RealisateurBO(
            $row['idRealisateur'],
            $row['nomRealisateur'],
            $row['prenomRealisateur'],
            $row['nationaliteRealisateur'],
            $row['recompenseRealisateur'],
            $row['photo']
        ) : null;
    }
}
