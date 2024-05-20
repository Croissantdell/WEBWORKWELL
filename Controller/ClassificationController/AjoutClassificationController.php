<?php

namespace Controller\ClassificationController;

use Model\DAO\ClassificationDAO;
use Model\BO\ClassificationBO;
use Controller\Database;
require_once __DIR__ . '/../VerificationController.php';

class AjoutClassificationController {
    public function ajouter() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $database = new Database();
            $db = $database->getConnection();

            $classificationDAO = new ClassificationDAO($db);
            $classification = new ClassificationBO();
            $classification->setLibelleClassification($_POST['libelle']);

            $classificationDAO->createClassification($classification);

            header('Location: /P2025/WEBWORKWELL/classification/liste');
        } else {
            require __DIR__ . '/../../View/Classifications/ajouterClassification.php';
        }
    }
}
