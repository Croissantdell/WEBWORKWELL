<?php

namespace Controller;

use Controller\OeuvreController\AjoutOeuvreController;
use Controller\OeuvreController\EditOeuvreController;
use Controller\OeuvreController\ListeOeuvreController;
use Controller\OeuvreController\SupprimerOeuvreController;
use Controller\OeuvreController\VoirOeuvreController;
require_once __DIR__ . '/VerificationController.php';

class OeuvreController {
    public function index() {
        $this->liste();
    }

    public function ajouter() {
        if (isLoggedIn()) {
            (new AjoutOeuvreController())->ajouterOeuvre();
        } else {
            header('Location: /P2025/WEBWORKWELL/authentification/login');
            exit;
        }
    }

    public function liste() {
        (new ListeOeuvreController())->listeOeuvres();
    }

    public function modifier($id) {
        if (isLoggedIn()) {
            (new EditOeuvreController())->modifierOeuvre($id);
        } else {
            header('Location: /P2025/WEBWORKWELL/authentification/login');
            exit;
        }
    }

    public function supprimer($id) {
        if (isLoggedIn()) {
            (new SupprimerOeuvreController())->supprimerOeuvre($id);
        } else {
            header('Location: /P2025/WEBWORKWELL/authentification/login');
            exit;
        }
    }

    public function voir($id) {
        (new VoirOeuvreController())->voirOeuvre($id);
    }
}
