<?php

namespace Model\DAO;

use PDO;
use Model\BO\JouerBO;
use Model\BO\ActeurBO;
use Model\BO\OeuvreBO;

class JouerDAO {
    private $bdd;

    public function __construct(PDO $bdd) {
        $this->bdd = $bdd;
    }

    public function createJouer(JouerBO $jouer) {
        $query = "INSERT INTO jouer (idActeur, codeOeuvre, roleActeur) VALUES (:idActeur, :codeOeuvre, :roleActeur)";
        $stmt = $this->bdd->prepare($query);
        return $stmt->execute([
            ':idActeur' => $jouer->getIdActeur(),
            ':codeOeuvre' => $jouer->getCodeOeuvre(),
            ':roleActeur' => $jouer->getRoleActeur()
        ]);
    }

    public function getActeursByOeuvre(int $codeOeuvre) {
        $query = "SELECT a.*, j.roleActeur FROM acteur a
                  JOIN jouer j ON a.idActeur = j.idActeur
                  WHERE j.codeOeuvre = :codeOeuvre";
        $stmt = $this->bdd->prepare($query);
        $stmt->execute([':codeOeuvre' => $codeOeuvre]);
        $resultSet = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $acteur = new ActeurBO(
                $row['idActeur'],
                $row['nomActeur'],
                $row['prenomActeur'],
                $row['nationaliteActeur'],
                new \DateTime($row['dateNaissanceActeur']),
                $row['photo']
            );
            $resultSet[] = [
                'acteur' => $acteur,
                'roleActeur' => $row['roleActeur']
            ];
        }
        return $resultSet;
    }

    public function getOeuvresByActeur(int $idActeur) {
        $query = "SELECT o.* FROM oeuvre o
                  JOIN jouer j ON o.codeOeuvre = j.codeOeuvre
                  WHERE j.idActeur = :idActeur";
        $stmt = $this->bdd->prepare($query);
        $stmt->execute([':idActeur' => $idActeur]);
        $resultSet = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
        return $resultSet;
    }

    public function deleteJouer(int $idActeur, int $codeOeuvre) {
        $query = "DELETE FROM jouer WHERE idActeur = :idActeur AND codeOeuvre = :codeOeuvre";
        $stmt = $this->bdd->prepare($query);
        return $stmt->execute([
            ':idActeur' => $idActeur,
            ':codeOeuvre' => $codeOeuvre
        ]);
    }

    public function deleteAllByOeuvre(int $codeOeuvre) {
        $query = "DELETE FROM jouer WHERE codeOeuvre = :codeOeuvre";
        $stmt = $this->bdd->prepare($query);
        return $stmt->execute([':codeOeuvre' => $codeOeuvre]);
    }

    public function getAllJouer() {
        $query = "SELECT * FROM jouer";
        $stmt = $this->bdd->query($query);
        $resultSet = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $resultSet[] = new JouerBO(
                $row['idActeur'],
                $row['codeOeuvre'],
                $row['roleActeur']
            );
        }
        return $resultSet;
    }
}
