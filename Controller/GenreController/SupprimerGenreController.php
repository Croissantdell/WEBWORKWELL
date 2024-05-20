<?php

namespace Controller\GenreController;

use Model\DAO\GenreDAO;
use Controller\Database;
require_once __DIR__ . '/../VerificationController.php';

class SupprimerGenreController {
    public function supprimer($id) {

        $database = new Database();
        $db = $database->getConnection();

        $genreDAO = new GenreDAO($db);
        $genreDAO->deleteGenre($id);

        header('Location:  /P2025/WEBWORKWELL/genre/liste');
    }
}
