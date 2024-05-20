<?php

namespace Controller;

use Controller\ClassificationController\AjoutClassificationController;
use Controller\ClassificationController\EditClassificationController;
use Controller\ClassificationController\ListeClassificationController;
use Controller\ClassificationController\SupprimerClassificationController;
use Controller\ClassificationController\VoirClassificationController;
require_once __DIR__ . '/VerificationController.php';

class ClassificationController {
    public function index() {
                if (isLoggedIn()) {

        $this->liste();}
                else {
                    header('Location: /P2025/WEBWORKWELL/authentification/login');
                    exit;
                }
    }

    public function ajouter() {
        if (isLoggedIn()) {
            (new AjoutClassificationController())->ajouter();
        } else {
            header('Location: /P2025/WEBWORKWELL/authentification/login');
            exit;
        }
    }

    public function liste() {
                if (isLoggedIn()) {
        (new ListeClassificationController())->liste();}
                else {
                    header('Location: /P2025/WEBWORKWELL/authentification/login');
                    exit;
                }
    }

    public function modifier($id) {
        if (isLoggedIn()) {
            (new EditClassificationController())->modifier($id);
        } else {
            header('Location: /P2025/WEBWORKWELL/authentification/login');
            exit;
        }
    }

    public function supprimer($id) {
        if (isLoggedIn()) {
            (new SupprimerClassificationController())->supprimer($id);
        } else {
            header('Location: /P2025/WEBWORKWELL/authentification/login');
            exit;
        }
    }

    public function voir($id) {                if (isLoggedIn()) {

        (new VoirClassificationController())->voir($id);}
        else {
            header('Location: /P2025/WEBWORKWELL/authentification/login');
            exit;
        }
    }
}
?>
