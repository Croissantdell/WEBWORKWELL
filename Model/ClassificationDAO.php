<?php

require_once '../Database.php';
require_once 'ClassificationBO.php';


class ClassificationDAO {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getAllClassifications() {
        $sql = 'SELECT * FROM Classification';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getClassificationByCode($codeClassification) {
        $sql = 'SELECT * FROM Classification WHERE codeClassification = :codeClassification';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':codeClassification', $codeClassification);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getClassificationByOeuvre($codeOeuvre): ?ClassificationBO {
        $sql = "SELECT c.* FROM OEUVRE_CLASSIFICATION oc JOIN CLASSIFICATION c ON oc.codeClassification = c.codeClassification WHERE oc.codeOeuvre = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$codeOeuvre]);
        $row = $stmt->fetch();
        return $row ? new ClassificationBO($row['codeClassification'], $row['libelleClassification']) : null;
    }
}