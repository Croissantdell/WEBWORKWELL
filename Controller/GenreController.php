<?php

namespace Controller;

use Controller\GenreController\AjoutGenreController;
use Controller\GenreController\EditGenreController;
use Controller\GenreController\ListeGenreController;
use Controller\GenreController\SupprimerGenreController;
use Controller\GenreController\VoirGenreController;
require_once __DIR__ . '/VerificationController.php';

class GenreController {
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
            (new AjoutGenreController())->ajouter();
        } else {
            header('Location: /P2025/WEBWORKWELL/authentification/login');
            exit;
        }
    }

    public function liste() {        if (isLoggedIn()) {

        (new ListeGenreController())->liste();
    } else {
        header('Location: /P2025/WEBWORKWELL/authentification/login');
        exit;
    }
    }

    public function modifier($id) {
        if (isLoggedIn()) {
            (new EditGenreController())->modifier($id);
        } else {
            header('Location: /P2025/WEBWORKWELL/authentification/login');
            exit;
        }
    }

    public function supprimer($id) {
        if (isLoggedIn()) {
            (new SupprimerGenreController())->supprimer($id);
        } else {
            header('Location: /P2025/WEBWORKWELL/authentification/login');
            exit;
        }
    }

    public function voir($id) {        if (isLoggedIn()) {

        (new VoirGenreController())->voir($id);}else {
        header('Location: /P2025/WEBWORKWELL/authentification/login');
        exit;
    }
    }
}
