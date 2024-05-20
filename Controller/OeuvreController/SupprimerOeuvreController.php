<?php

namespace Controller\OeuvreController;

use Model\DAO\OeuvreDAO;
use Model\DAO\JouerDAO;
use Model\DAO\RealiserDAO;
use Controller\Database;

class SupprimerOeuvreController {
    public function supprimerOeuvre($codeOeuvre) {
        $database = new Database();
        $db = $database->getConnection();

        $oeuvreDAO = new OeuvreDAO($db);
        $jouerDAO = new JouerDAO($db);
        $realiserDAO = new RealiserDAO($db);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $jouerDAO->deleteAllByOeuvre($codeOeuvre);
            $realiserDAO->deleteAllByOeuvre($codeOeuvre);

            $oeuvreDAO->deleteOeuvre($codeOeuvre);

            header('Location: /P2025/WEBWORKWELL/oeuvre/liste');
        } else {
            $oeuvre = $oeuvreDAO->findOeuvre($codeOeuvre);
            require __DIR__ . '/../../View/Oeuvres/supprimerOeuvre.php';
        }
    }
}
