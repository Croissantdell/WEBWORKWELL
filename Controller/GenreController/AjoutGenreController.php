<?php

namespace Controller\GenreController;

use Model\DAO\GenreDAO;
use Model\BO\GenreBO;
use Controller\Database;
require_once __DIR__ . '/../VerificationController.php';

class AjoutGenreController {
    public function ajouter() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $database = new Database();
            $db = $database->getConnection();

            $genreDAO = new GenreDAO($db);
            $genre = new GenreBO();
            $genre->setLibelleGenre($_POST['libelle']);

            $genreDAO->createGenre($genre);

            header('Location: /P2025/WEBWORKWELL/genre/liste');
        } else {
            require __DIR__ . '/../../View/Genres/ajouterGenre.php';
        }
    }
}
