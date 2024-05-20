<?php
namespace Controller\ActeurController;

use Model\DAO\ActeurDAO;
use Model\BO\ActeurBO;
use Controller\Database;

class AjoutActeurController {
    public function ajouter() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $database = new Database();
            $db = $database->getConnection();

            $acteurDAO = new ActeurDAO($db);
            $acteur = new ActeurBO();
            $acteur->setNomActeur($_POST['nom']);
            $acteur->setPrenomActeur($_POST['prenom']);
            $acteur->setNationaliteActeur($_POST['nationalite']);
            $acteur->setDateNaissanceActeur(new \DateTime($_POST['date_naissance']));

            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['photo']['tmp_name'];
                $fileName = $_FILES['photo']['name'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                $uploadFileDir = __DIR__ . '/../../Image/Acteur/';
                $dest_path = $uploadFileDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $acteur->setPhoto($newFileName);
                }
            }

            $acteur = $acteurDAO->createActeur($acteur);

            header('Location: /P2025/WEBWORKWELL/acteur/voir/' . $acteur->getIdActeur());
            exit();
        } else {
            require __DIR__ . '/../../View/Acteurs/ajouterActeur.php';
        }
    }
}
