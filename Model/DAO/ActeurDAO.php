<?php

namespace Model\DAO;

use Model\BO\ActeurBO;
use \PDO;


class ActeurDAO {
    private $bdd;

    public function __construct(PDO $bdd) {
        $this->bdd = $bdd;
    }

    public function getAllActeur() {
        $query = "SELECT * FROM acteur";
        $stmt = $this->bdd->query($query);
        $resultSet = [];
        if ($stmt) {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($stmt as $row) {
                $resultSet[] = new ActeurBO(
                    $row['idActeur'],
                    $row['nomActeur'],
                    $row['prenomActeur'],
                    $row['nationaliteActeur'],
                    new \DateTime($row['dateNaissanceActeur']),
                    $row['photo']
                );
            }
        }
        return $resultSet;
    }

    public function findActeur(int $id) {
        $query = "SELECT * FROM acteur WHERE idActeur = :id";
        $stmt = $this->bdd->prepare($query);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new ActeurBO(
            $row['idActeur'],
            $row['nomActeur'],
            $row['prenomActeur'],
            $row['nationaliteActeur'],
            new \DateTime($row['dateNaissanceActeur']),
            $row['photo']
        ) : null;
    }

    public function createActeur(ActeurBO $entity) {
        $query = "INSERT INTO acteur (nomActeur, prenomActeur, nationaliteActeur, dateNaissanceActeur, photo) VALUES (:nomAct, :preAct, :natAct, :datNai, :photo)";
        $stmt = $this->bdd->prepare($query);
        $res = $stmt->execute([
            ':nomAct' => $entity->getNomActeur(),
            ':preAct' => $entity->getPrenomActeur(),
            ':natAct' => $entity->getNationaliteActeur(),
            ':datNai' => $entity->getDateNaissanceActeur()->format('Y-m-d'),
            ':photo' => $entity->getPhoto()
        ]);
        if ($res) {
            $entity->setIdActeur($this->bdd->lastInsertId());
        }
        return $res ? $entity : null;
    }

    public function updateActeur(ActeurBO $entity) {
        $query = "UPDATE acteur SET nomActeur = :nomAct, prenomActeur = :preAct, nationaliteActeur = :natAct, dateNaissanceActeur = :datNai, photo = :photo WHERE idActeur = :idAct";
        $stmt = $this->bdd->prepare($query);
        $res = $stmt->execute([
            ':nomAct' => $entity->getNomActeur(),
            ':preAct' => $entity->getPrenomActeur(),
            ':natAct' => $entity->getNationaliteActeur(),
            ':datNai' => $entity->getDateNaissanceActeur()->format('Y-m-d'),
            ':photo' => $entity->getPhoto(),
            ':idAct' => $entity->getIdActeur()
        ]);
        return $res ? $entity : false;
    }

    public function deleteActeur(int $id) {
        $query = "DELETE FROM acteur WHERE idActeur = :idAct";
        $stmt = $this->bdd->prepare($query);
        return $stmt->execute([':idAct' => $id]);
    }
}
