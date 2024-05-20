<?php

namespace Model\DAO;

use Model\BO\ClassificationBO;
use \PDO;

class ClassificationDAO {
    private $bdd;

    public function __construct(PDO $bdd) {
        $this->bdd = $bdd;
    }

    public function getAllClassifications() {
        $query = "SELECT * FROM classification";
        $stmt = $this->bdd->query($query);
        $resultSet = [];
        if ($stmt) {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($stmt as $row) {
                $resultSet[] = new ClassificationBO($row['codeClassification'], $row['libelleClassification']);
            }
        }
        return $resultSet;
    }

    public function findClassification(int $id) {
        $query = "SELECT * FROM classification WHERE codeClassification = :id";
        $stmt = $this->bdd->prepare($query);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new ClassificationBO($row['codeClassification'], $row['libelleClassification']) : null;
    }

    public function createClassification(ClassificationBO $entity) {
        $query = "INSERT INTO classification (libelleClassification) VALUES (:libelle)";
        $stmt = $this->bdd->prepare($query);
        $res = $stmt->execute([':libelle' => $entity->getLibelleClassification()]);
        if ($res) {
            $entity->setCodeClassification($this->bdd->lastInsertId());
        }
        return $res ? $entity : null;
    }

    public function updateClassification(ClassificationBO $entity) {
        $query = "UPDATE classification SET libelleClassification = :libelle WHERE codeClassification = :id";
        $stmt = $this->bdd->prepare($query);
        $res = $stmt->execute([
            ':libelle' => $entity->getLibelleClassification(),
            ':id' => $entity->getCodeClassification()
        ]);
        return $res ? $entity : false;
    }

    public function deleteClassification(int $id) {
        $query = "DELETE FROM classification WHERE codeClassification = :id";
        $stmt = $this->bdd->prepare($query);
        return $stmt->execute([':id' => $id]);
    }
}
