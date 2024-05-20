<?php

namespace Controller\RealisateurController;

use Model\DAO\RealisateurDAO;
use Controller\Database;

class ListeRealisateurController {
    public function liste() {
        $database = new Database();
        $db = $database->getConnection();

        $realisateurDAO = new RealisateurDAO($db);
        $realisateurs = $realisateurDAO->getAllRealisateurs();

        require __DIR__ . '/../../View/Realisateurs/listeRealisateurs.php';
    }
}
