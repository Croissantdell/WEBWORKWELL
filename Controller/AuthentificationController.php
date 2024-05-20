<?php

namespace Controller;

use Model\DAO\CompteDAO;
use Model\BO\CompteBO;
use Controller\Database;

class AuthentificationController {
    public function login() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $database = new Database();
        $db = $database->getConnection();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = $_POST['login'];
            $motDePasse = $_POST['motDePasse'];

            $compteDAO = new CompteDAO($db);
            $compte = $compteDAO->findByLogin($login);

            if ($compte && password_verify($motDePasse, $compte->getMotDePasse())) {
                session_start();
                $_SESSION['user_id'] = $compte->getIdCompte();
                $_SESSION['username'] = $compte->getLogin();
                header('Location: /P2025/WEBWORKWELL/accueil');
                exit;
            } else {
                $error = "Identifiants incorrects.";
            }
        }

        require __DIR__ . '/../View/login.php';
    }

    public function inscription() {
        $database = new Database();
        $db = $database->getConnection();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = $_POST['login'];
            $motDePasse = password_hash($_POST['motDePasse'], PASSWORD_BCRYPT);

            $compteDAO = new CompteDAO($db);
            $compte = new CompteBO(null, $login, $motDePasse);

            if ($compteDAO->createCompte($compte)) {
                header('Location: /P2025/WEBWORKWELL/authentification/login');
                exit;
            } else {
                $error = "Erreur lors de la création du compte.";
            }
        }

        require __DIR__ . '/../View/inscription.php';
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /P2025/WEBWORKWELL/accueil');
        exit;
    }
}
