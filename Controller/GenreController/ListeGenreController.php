<?php

namespace Controller\GenreController;

use Model\DAO\GenreDAO;
use Controller\Database;
require_once __DIR__ . '/../VerificationController.php';

class ListeGenreController {
    public function liste() {

        $database = new Database();
        $db = $database->getConnection();

        $genreDAO = new GenreDAO($db);
        $genres = $genreDAO->getAllGenres();

        require __DIR__ . '/../../View/Genres/listeGenres.php';
    }
}
