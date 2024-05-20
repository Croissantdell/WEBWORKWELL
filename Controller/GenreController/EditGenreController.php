<?php

namespace Controller\GenreController;

use Model\DAO\GenreDAO;
use Model\BO\GenreBO;
use Controller\Database;
require_once __DIR__ . '/../VerificationController.php';

class EditGenreController {
    public function modifier($id) {

        $database = new Database();
        $db = $database->getConnection();

        $genreDAO = new GenreDAO($db);
        $genre = $genreDAO->findGenre($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $genre->setLibelleGenre($_POST['libelle']);
            $genreDAO->updateGenre($genre);

            header('Location:  /P2025/WEBWORKWELL/genre/liste');
        } else {
            require __DIR__ . '/../../View/Genres/modifierGenre.php';
        }
    }
}
