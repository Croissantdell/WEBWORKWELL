<?php

namespace Controller\OeuvreController;

use Model\DAO\OeuvreDAO;
use Model\DAO\RealisateurDAO;
use Model\DAO\GenreDAO;
use Controller\Database;

class ListeOeuvreController {
    public function listeOeuvres() {
        $database = new Database();
        $db = $database->getConnection();

        $oeuvreDAO = new OeuvreDAO($db);
        $realisateurDAO = new RealisateurDAO($db);
        $genreDAO = new GenreDAO($db);

        $search = $_GET['search'] ?? '';
        $filter = $_GET['filter'] ?? '';

        $oeuvres = $oeuvreDAO->getFilteredOeuvres($search, $filter);
        $oeuvresavecDetails = [];

        foreach ($oeuvres as $oeuvre) {
            $details = [];
            $details['oeuvre'] = $oeuvre;
            $details['realisateur'] = $realisateurDAO->getRealisateurByOeuvre($oeuvre->getCodeOeuvre());
            $details['genres'] = $genreDAO->getGenresByOeuvre($oeuvre->getCodeOeuvre());
            $oeuvresavecDetails[] = $details;
        }

        require __DIR__ . '/../../View/Oeuvres/listeOeuvres.php';
    }
}
