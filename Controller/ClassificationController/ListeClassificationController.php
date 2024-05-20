<?php

namespace Controller\ClassificationController;

use Model\DAO\ClassificationDAO;
use Controller\Database;
require_once __DIR__ . '/../VerificationController.php';

class ListeClassificationController {
    public function liste() {


        $database = new Database();
        $db = $database->getConnection();

        $classificationDAO = new ClassificationDAO($db);
        $classifications = $classificationDAO->getAllClassifications();

        require __DIR__ . '/../../View/Classifications/listeClassification.php';
    }
}
