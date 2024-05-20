<?php

namespace Controller\ClassificationController;

use Model\DAO\ClassificationDAO;
use Controller\Database;
require_once __DIR__ . '/../VerificationController.php';

class VoirClassificationController {
    public function voir($id) {

        $database = new Database();
        $db = $database->getConnection();

        $classificationDAO = new ClassificationDAO($db);
        $classification = $classificationDAO->findClassification($id);

        require __DIR__ . '/../../View/Classifications/voirClassification.php';
    }
}
