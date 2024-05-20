<?php

namespace Controller\ActeurController;

use Model\DAO\ActeurDAO;
use Controller\Database;

class SupprimerActeurController {
    public function supprimer($id) {
        $database = new Database();
        $db = $database->getConnection();

        $acteurDAO = new ActeurDAO($db);
        $acteurDAO->deleteActeur($id);

        header('Location: /P2025/WEBWORKWELL/acteur/liste');
    }
}
