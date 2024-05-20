<?php

namespace Controller\ActeurController;
use Controller\database;
use Model\DAO\ActeurDAO;

class ListeActeurController {
    public function liste() {
        $database = new Database();
        $db = $database->getConnection();

        $acteurDAO = new ActeurDAO($db);
        $acteurs = $acteurDAO->getAllActeur();

        require 'View/Acteurs/listeActeurs.php';
    }
}
