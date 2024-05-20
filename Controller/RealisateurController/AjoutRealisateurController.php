<?php

namespace Controller\RealisateurController;

use Model\DAO\RealisateurDAO;
use Model\BO\RealisateurBO;
use Controller\Database;

class AjoutRealisateurController {
    public function ajouter() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $database = new Database();
            $db = $database->getConnection();

            $realisateurDAO = new RealisateurDAO($db);
            $realisateur = new RealisateurBO();
            $realisateur->setNomRealisateur($_POST['nom']);
            $realisateur->setPrenomRealisateur($_POST['prenom']);
            $realisateur->setNationaliteRealisateur($_POST['nationalite']);
            $realisateur->setRecompenseRealisateur($_POST['recompense']);

            // Gestion de l'upload de la photo
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['photo']['tmp_name'];
                $fileName = $_FILES['photo']['name'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                $uploadFileDir = __DIR__ . '/../../Image/Realisateur/';
                $dest_path = $uploadFileDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $realisateur->setPhoto('/P2025/WEBWORKWELL/Image/Realisateur/' . $newFileName);
                } else {
                    $realisateur->setPhoto(null);
                }
            } else {
                $realisateur->setPhoto(null);
            }

            $createdRealisateur = $realisateurDAO->createRealisateur($realisateur);

            if ($createdRealisateur) {
                $realisateurId = $realisateur->getIdRealisateur();
                header('Location: /P2025/WEBWORKWELL/realisateur/voir/' . $realisateurId);
                exit();
            } else {
                // Handle error if the creation failed
                // Redirect to a different page or display an error message
            }
        } else {
            require __DIR__ . '/../../View/Realisateurs/ajouterRealisateur.php';
        }
    }
}
