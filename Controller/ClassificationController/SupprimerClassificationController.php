<?php

namespace Controller\ClassificationController;

use Model\DAO\ClassificationDAO;
use Controller\Database;
require_once __DIR__ . '/../VerificationController.php';

class SupprimerClassificationController {
    public function supprimer($id) {


        $database = new Database();
        $db = $database->getConnection();

        $classificationDAO = new ClassificationDAO($db);
        $classificationDAO->deleteClassification($id);

        header('Location: /P2025/WEBWORKWELL/classification/liste');
    }
}
