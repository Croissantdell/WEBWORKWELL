<?php
namespace Controller\ActeurController;

use Model\DAO\ActeurDAO;
use Model\DAO\JouerDAO;
use Model\DAO\OeuvreDAO;
use Controller\Database;
require_once __DIR__ . '/../VerificationController.php';

class VoirActeurController {
    public function voir($id) {
        $database = new Database();
        $db = $database->getConnection();

        $acteurDAO = new ActeurDAO($db);
        $jouerDAO = new JouerDAO($db);
        $oeuvreDAO = new OeuvreDAO($db);

        $acteur = $acteurDAO->findActeur($id);
        $oeuvres = $jouerDAO->getOeuvresByActeur($id);

        $isLoggedIn = isLoggedIn();

        require __DIR__ . '/../../View/Acteurs/voirActeur.php';
    }
}
