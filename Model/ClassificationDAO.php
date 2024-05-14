<?php

require_once '../Database.php';
require_once 'ClassificationBO.php';

class ClassificationDAO {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    /**
     * Récupère toutes les classifications.
     * @return ClassificationBO[] Tableau d'objets ClassificationBO.
     */
    public function getAllClassifications(): array {
        $sql = 'SELECT * FROM Classification';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $classifications = [];
        foreach ($rows as $row) {
            $classifications[] = new ClassificationBO($row['codeClassification'], $row['libelleClassification']);
        }
        return $classifications;
    }

    /**
     * Récupère une classification par son code.
     * @param string $codeClassification
     * @return ClassificationBO|null
     */
    public function getClassificationByCode(string $codeClassification): ?ClassificationBO {
        $sql = 'SELECT * FROM Classification WHERE codeClassification = :codeClassification';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':codeClassification', $codeClassification);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? new ClassificationBO($row['codeClassification'], $row['libelleClassification']) : null;
    }

    /**
     * Récupère les classifications associées à une œuvre.
     * @param int $codeOeuvre
     * @return ClassificationBO[] Tableau d'objets ClassificationBO.
     */
    public function getClassificationsByOeuvre(int $codeOeuvre): array {
        $sql = "SELECT c.* FROM oeuvre_classification oc 
                JOIN classification c ON oc.codeClassification = c.codeClassification 
                WHERE oc.codeOeuvre = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$codeOeuvre]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $classifications = [];
        foreach ($rows as $row) {
            $classifications[] = new ClassificationBO($row['codeClassification'], $row['libelleClassification']);
        }

        return $classifications;
    }

    /**
     * Crée une nouvelle classification.
     * @param ClassificationBO $classification
     * @return bool
     */
    public function createClassification(ClassificationBO $classification): bool {
        $sql = "INSERT INTO classification (codeClassification, libelleClassification) VALUES (:codeClassification, :libelleClassification)";
        $stmt = $this->db->prepare($sql);

        $codeClassification = $classification->getCodeClassification();
        $libelleClassification = $classification->getLibelleClassification();

        $stmt->bindParam(':codeClassification', $codeClassification);
        $stmt->bindParam(':libelleClassification', $libelleClassification);

        return $stmt->execute();
    }

    public function getClassificationsByOeuvre1($codeOeuvre) {
        $sql = "SELECT c.codeClassification, c.libelleClassification FROM oeuvre_classification oc 
                JOIN classification c ON oc.codeClassification = c.codeClassification 
                WHERE oc.codeOeuvre = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$codeOeuvre]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $classifications = [];
        foreach ($result as $row) {
            $classifications[] = new ClassificationBO($row['codeClassification'], $row['libelleClassification']);
        }

        return $classifications;
    }
}
?>
