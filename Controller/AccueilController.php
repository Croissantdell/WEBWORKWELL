<?php

namespace Controller;

use Model\DAO\OeuvreDAO;
use Model\DAO\RealisateurDAO;
use Model\DAO\GenreDAO;
use Controller\Database;

require_once 'VerificationController.php';

class AccueilController {
    public function index() {
        $database = new Database();
        $db = $database->getConnection();

        $oeuvreDAO = new OeuvreDAO($db);
        $realisateurDAO = new RealisateurDAO($db);
        $genreDAO = new GenreDAO($db);

        $latestOeuvres = $oeuvreDAO->getLatestOeuvres();
        $oeuvresWithDetails = [];

        foreach ($latestOeuvres as $oeuvre) {
            $realisateur = $realisateurDAO->getRealisateurByOeuvre($oeuvre->getCodeOeuvre());
            $genres = $genreDAO->getGenresByOeuvre($oeuvre->getCodeOeuvre());
            $oeuvresWithDetails[] = [
                'oeuvre' => $oeuvre,
                'realisateur' => $realisateur,
                'genres' => $genres
            ];
        }

        require __DIR__ . '/../View/accueil.php';
    }
}
