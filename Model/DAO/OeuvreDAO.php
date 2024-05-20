<?php

namespace Model\DAO;

use Model\BO\OeuvreBO;
use PDO;

class OeuvreDAO {
    private $bdd;

    public function __construct(PDO $bdd) {
        $this->bdd = $bdd;
    }

    public function getAllOeuvres() {
        $query = "SELECT * FROM oeuvre";
        $stmt = $this->bdd->query($query);
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

    public function getLatestOeuvres() {
        $query = "SELECT * FROM oeuvre ORDER BY anneeSortieOeuvre DESC LIMIT 3";
        $stmt = $this->bdd->query($query);
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

    public function findOeuvre(int $id) {
        $query = "SELECT * FROM oeuvre WHERE codeOeuvre = :id";
        $stmt = $this->bdd->prepare($query);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new OeuvreBO(
            $row['codeOeuvre'],
            $row['titreOriginalOeuvre'],
            $row['titreFrancaisOeuvre'],
            $row['anneeSortieOeuvre'],
            $row['resumeOeuvre'],
            $row['nbEpisodeOeuvre'],
            $row['affiche'],
            $row['codeClassification'],
            $row['idGenre']
        ) : null;
    }

    public function createOeuvre(OeuvreBO $entity) {
        $query = "INSERT INTO oeuvre (titreOriginalOeuvre, titreFrancaisOeuvre, anneeSortieOeuvre, resumeOeuvre, nbEpisodeOeuvre, affiche, codeClassification, idGenre) VALUES (:titreOrig, :titreFr, :anneeSortie, :resume, :nbEpisodes, :affiche, :codeClass, :idGenre)";
        $stmt = $this->bdd->prepare($query);
        $res = $stmt->execute([
            ':titreOrig' => $entity->getTitreOriginalOeuvre(),
            ':titreFr' => $entity->getTitreFrancaisOeuvre(),
            ':anneeSortie' => $entity->getAnneeSortieOeuvre(),
            ':resume' => $entity->getResumeOeuvre(),
            ':nbEpisodes' => $entity->getNbEpisodeOeuvre(),
            ':affiche' => $entity->getAffiche(),
            ':codeClass' => $entity->getCodeClassification(),
            ':idGenre' => $entity->getIdGenre()
        ]);
        if ($res) {
            $entity->setCodeOeuvre($this->bdd->lastInsertId());
        }
        return $res ? $entity : null;
    }

    public function updateOeuvre(OeuvreBO $entity) {
        $query = "UPDATE oeuvre SET titreOriginalOeuvre = :titreOrig, titreFrancaisOeuvre = :titreFr, anneeSortieOeuvre = :anneeSortie, resumeOeuvre = :resume, nbEpisodeOeuvre = :nbEpisodes, affiche = :affiche, codeClassification = :codeClass, idGenre = :idGenre WHERE codeOeuvre = :id";
        $stmt = $this->bdd->prepare($query);
        $res = $stmt->execute([
            ':titreOrig' => $entity->getTitreOriginalOeuvre(),
            ':titreFr' => $entity->getTitreFrancaisOeuvre(),
            ':anneeSortie' => $entity->getAnneeSortieOeuvre(),
            ':resume' => $entity->getResumeOeuvre(),
            ':nbEpisodes' => $entity->getNbEpisodeOeuvre(),
            ':affiche' => $entity->getAffiche(),
            ':codeClass' => $entity->getCodeClassification(),
            ':idGenre' => $entity->getIdGenre(),
            ':id' => $entity->getCodeOeuvre()
        ]);
        return $res ? $entity : false;
    }

    public function deleteOeuvre(int $id) {
        $query = "DELETE FROM oeuvre WHERE codeOeuvre = :id";
        $stmt = $this->bdd->prepare($query);
        return $stmt->execute([':id' => $id]);
    }
    public function getFilteredOeuvres($search = '', $filter = '') {
        $query = "SELECT o.* FROM oeuvre o";
        $params = [];

        if ($filter === 'film' || $filter === 'serie' || $filter === 'anime') {
            $query .= " INNER JOIN classification c ON o.codeClassification = c.codeClassification";
        } elseif ($filter === 'genre') {
            $query .= " INNER JOIN genre g ON o.idGenre = g.idGenre";
        } elseif ($filter === 'auteur') {
            $query .= " INNER JOIN realiser r ON o.codeOeuvre = r.codeOeuvre INNER JOIN realisateur re ON r.idRealisateur = re.idRealisateur";
        } elseif ($filter === 'acteur') {
            $query .= " INNER JOIN jouer j ON o.codeOeuvre = j.codeOeuvre INNER JOIN acteur a ON j.idActeur = a.idActeur";
        }

        $query .= " WHERE 1=1";
        if (!empty($search)) {
            $query .= " AND (o.titreOriginalOeuvre LIKE :search OR o.titreFrancaisOeuvre LIKE :search)";
            $params[':search'] = '%' . $search . '%';
        }

        if ($filter === 'film') {
            $query .= " AND c.libelleClassification = 'Film'";
        } elseif ($filter === 'serie') {
            $query .= " AND c.libelleClassification = 'Série'";
        } elseif ($filter === 'anime') {
            $query .= " AND c.libelleClassification = 'Manga'";
        } elseif ($filter === 'genre') {
        } elseif ($filter === 'auteur') {
        } elseif ($filter === 'acteur') {
        } elseif ($filter === 'date') {
            $query .= " ORDER BY o.anneeSortieOeuvre DESC";
        }

        $stmt = $this->bdd->prepare($query);
        $stmt->execute($params);

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


}
