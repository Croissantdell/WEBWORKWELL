<?php

namespace Controller\RealisateurController;

use Model\DAO\RealisateurDAO;
use Controller\Database;

class SupprimerRealisateurController {
    public function supprimer($id) {
        $database = new Database();
        $db = $database->getConnection();

        $realisateurDAO = new RealisateurDAO($db);
        $realisateurDAO->deleteRealisateur($id);

        header('Location: /P2025/WEBWORKWELL/realisateur/liste');
    }
}
