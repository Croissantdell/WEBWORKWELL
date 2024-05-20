<?php

namespace Model\DAO;

use PDO;
use Model\BO\RealiserBO;
use Model\BO\RealisateurBO;
use Model\DAO\OeuvreDAO;
use Model\BO\OeuvreBO;

class RealiserDAO {
    private $bdd;

    public function __construct(PDO $bdd) {
        $this->bdd = $bdd;
    }

    public function createRealiser(RealiserBO $realiser) {
        $query = "INSERT INTO realiser (idRealisateur, codeOeuvre) VALUES (:idRealisateur, :codeOeuvre)";
        $stmt = $this->bdd->prepare($query);
        return $stmt->execute([
            ':idRealisateur' => $realiser->getIdRealisateur(),
            ':codeOeuvre' => $realiser->getCodeOeuvre()
        ]);
    }

    public function getRealisateursByOeuvre(int $codeOeuvre) {
        $query = "SELECT r.* FROM realisateur r
                  JOIN realiser re ON r.idRealisateur = re.idRealisateur
                  WHERE re.codeOeuvre = :codeOeuvre";
        $stmt = $this->bdd->prepare($query);
        $stmt->execute([':codeOeuvre' => $codeOeuvre]);
        $resultSet = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $resultSet[] = new RealisateurBO(
                $row['idRealisateur'],
                $row['nomRealisateur'],
                $row['prenomRealisateur'],
                $row['nationaliteRealisateur'],
                $row['recompenseRealisateur'],
                $row['photo']
            );
        }
        return $resultSet;
    }

    public function getOeuvresByRealisateur(int $idRealisateur) {
        $query = "SELECT o.* FROM oeuvre o
                  JOIN realiser re ON o.codeOeuvre = re.codeOeuvre
                  WHERE re.idRealisateur = :idRealisateur";
        $stmt = $this->bdd->prepare($query);
        $stmt->execute([':idRealisateur' => $idRealisateur]);
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

    public function deleteRealiser(int $idRealisateur, int $codeOeuvre) {
        $query = "DELETE FROM realiser WHERE idRealisateur = :idRealisateur AND codeOeuvre = :codeOeuvre";
        $stmt = $this->bdd->prepare($query);
        return $stmt->execute([
            ':idRealisateur' => $idRealisateur,
            ':codeOeuvre' => $codeOeuvre
        ]);
    }

    public function getAllRealiser() {
        $query = "SELECT * FROM realiser";
        $stmt = $this->bdd->query($query);
        $resultSet = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $resultSet[] = new RealiserBO(
                $row['idRealisateur'],
                $row['codeOeuvre']
            );
        }
        return $resultSet;
    }
    public function deleteAllByOeuvre(int $codeOeuvre) {
        $query = "DELETE FROM realiser WHERE codeOeuvre = :codeOeuvre";
        $stmt = $this->bdd->prepare($query);
        return $stmt->execute([':codeOeuvre' => $codeOeuvre]);
    }
}
