<?php
namespace Controller\OeuvreController;

use Model\DAO\OeuvreDAO;
use Model\DAO\JouerDAO;
use Model\DAO\RealiserDAO;
use Model\DAO\ClassificationDAO;
use Model\DAO\GenreDAO;
use Controller\Database;
require_once __DIR__ . '/../VerificationController.php';
class VoirOeuvreController {
    public function voirOeuvre($id) {
        $database = new Database();
        $db = $database->getConnection();

        $oeuvreDAO = new OeuvreDAO($db);
        $oeuvre = $oeuvreDAO->findOeuvre($id);

        $jouerDAO = new JouerDAO($db);
        $acteurs = $jouerDAO->getActeursByOeuvre($id);

        $realiserDAO = new RealiserDAO($db);
        $realisateurs = $realiserDAO->getRealisateursByOeuvre($id);

        $classificationDAO = new ClassificationDAO($db);
        $classification = $classificationDAO->findClassification($oeuvre->getCodeClassification());

        $genreDAO = new GenreDAO($db);
        $genre = $genreDAO->findGenre($oeuvre->getIdGenre());

        $isLoggedIn = isLoggedIn();

        require __DIR__ . '/../../View/Oeuvres/voirOeuvre.php';
    }
}
