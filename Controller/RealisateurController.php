<?php

namespace Controller;

use Controller\RealisateurController\AjoutRealisateurController;
use Controller\RealisateurController\EditRealisateurController;
use Controller\RealisateurController\ListeRealisateurController;
use Controller\RealisateurController\SupprimerRealisateurController;
use Controller\RealisateurController\VoirRealisateurController;
require_once __DIR__ . '/VerificationController.php';


class RealisateurController {
    public function index() {
        $this->liste();
    }

    public function ajouter() {
        if (isLoggedIn()) {
            (new AjoutRealisateurController())->ajouter();
        } else {
            header('Location: /P2025/WEBWORKWELL/authentification/login');
            exit;
        }
    }

    public function liste() {
        (new ListeRealisateurController())->liste();
    }

    public function modifier($id) {
        if (isLoggedIn()) {
            (new EditRealisateurController())->modifier($id);
        } else {
            header('Location: /P2025/WEBWORKWELL/authentification/login');
            exit;
        }
    }

    public function supprimer($id) {
        if (isLoggedIn()) {
            (new SupprimerRealisateurController())->supprimer($id);
        } else {
            header('Location: /P2025/WEBWORKWELL/authentification/login');
            exit;
        }
    }

    public function voir($id) {
        (new VoirRealisateurController())->voir($id);
    }
}
