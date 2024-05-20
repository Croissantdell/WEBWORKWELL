<?php

namespace Controller\GenreController;

use Model\DAO\GenreDAO;
use Controller\Database;
require_once __DIR__ . '/../VerificationController.php';

class VoirGenreController {
    public function voir($id) {

        $database = new Database();
        $db = $database->getConnection();

        $genreDAO = new GenreDAO($db);
        $genre = $genreDAO->findGenre($id);

        require __DIR__ . '/../../View/Genres/voirGenre.php';
    }
}
