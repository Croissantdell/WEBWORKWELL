<?php

namespace Controller\RealisateurController;

use Model\DAO\RealisateurDAO;
use Model\DAO\OeuvreDAO;
use Controller\Database;
use Model\DAO\RealiserDAO;

class VoirRealisateurController {
    public function voir($id) {
        $database = new Database();
        $db = $database->getConnection();

        $realisateurDAO = new RealisateurDAO($db);
        $realisateur = $realisateurDAO->findRealisateur($id);
        $realiserDAO = new RealiserDAO($db);

        $oeuvreDAO = new OeuvreDAO($db);
        $oeuvres = $realiserDAO->getOeuvresByRealisateur($id);

        require __DIR__ . '/../../View/Realisateurs/voirRealisateur.php';
    }
}
