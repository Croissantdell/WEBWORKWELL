<?php

namespace Controller\ClassificationController;

use Model\DAO\ClassificationDAO;
use Model\BO\ClassificationBO;
use Controller\Database;
require_once __DIR__ . '/../VerificationController.php';

class EditClassificationController {
    public function modifier($id) {


        $database = new Database();
        $db = $database->getConnection();

        $classificationDAO = new ClassificationDAO($db);
        $classification = $classificationDAO->findClassification($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $classification->setLibelleClassification($_POST['libelle']);
            $classificationDAO->updateClassification($classification);

            header('Location: /P2025/WEBWORKWELL/classification/liste');
        } else {
            require __DIR__ . '/../../View/Classifications/modifierClassification.php';
        }
    }
}
