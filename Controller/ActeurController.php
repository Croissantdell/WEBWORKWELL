<?php
namespace Controller;

use Controller\ActeurController\AjoutActeurController;
use Controller\ActeurController\EditActeurController;
use Controller\ActeurController\ListeActeurController;
use Controller\ActeurController\SupprimerActeurController;
use Controller\ActeurController\VoirActeurController;
require_once __DIR__ . '/VerificationController.php';

class ActeurController {
    public function index() {
        $this->liste();
    }

    public function ajouter() {
        if (isLoggedIn()) {
            (new AjoutActeurController())->ajouter();
        } else {
            header('Location: /P2025/WEBWORKWELL/authentification/login');
            exit;
        }
    }

    public function liste() {
        (new ListeActeurController())->liste();
    }

    public function modifier($id) {
        if (isLoggedIn()) {
            (new EditActeurController())->modifier($id);
        } else {
            header('Location: /P2025/WEBWORKWELL/authentification/login');
            exit;
        }
    }

    public function supprimer($id) {
        if (isLoggedIn()) {
            (new SupprimerActeurController())->supprimer($id);
        } else {
            header('Location: /P2025/WEBWORKWELL/authentification/login');
            exit;
        }
    }

    public function voir($id) {
        (new VoirActeurController())->voir($id);
    }
}

