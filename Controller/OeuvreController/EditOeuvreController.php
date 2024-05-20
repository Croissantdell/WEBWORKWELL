<?php

namespace Controller\OeuvreController;

use Model\DAO\OeuvreDAO;
use Model\DAO\GenreDAO;
use Model\DAO\ClassificationDAO;
use Model\DAO\ActeurDAO;
use Model\DAO\RealisateurDAO;
use Model\DAO\JouerDAO;
use Model\DAO\RealiserDAO;
use Model\BO\OeuvreBO;
use Model\BO\JouerBO;
use Model\BO\RealiserBO;
use Controller\Database;

class EditOeuvreController {
    public function modifierOeuvre($id) {
        $database = new Database();
        $db = $database->getConnection();

        $oeuvreDAO = new OeuvreDAO($db);
        $oeuvre = $oeuvreDAO->findOeuvre($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $oeuvre->setTitreOriginalOeuvre($_POST['titre_original']);
            $oeuvre->setTitreFrancaisOeuvre($_POST['titre_francais']);
            $oeuvre->setAnneeSortieOeuvre($_POST['annee_sortie']);
            $oeuvre->setResumeOeuvre($_POST['resume']);
            $oeuvre->setNbEpisodeOeuvre($_POST['nb_episodes']);
            $oeuvre->setCodeClassification($_POST['code_classification']);
            $oeuvre->setIdGenre($_POST['id_genre']);

            // Gérer le téléchargement de l'affiche
            if (isset($_FILES['affiche']) && $_FILES['affiche']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['affiche']['tmp_name'];
                $fileName = $_FILES['affiche']['name'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                $uploadFileDir = __DIR__ . '/../../Image/Oeuvre/';
                $dest_path = $uploadFileDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $oeuvre->setAffiche('/P2025/WEBWORKWELL/Image/Oeuvre/' . $newFileName);
                }
            }

            $oeuvreDAO->updateOeuvre($oeuvre);

            $jouerDAO = new JouerDAO($db);
            $jouerDAO->deleteAllByOeuvre($oeuvre->getCodeOeuvre());

            if (isset($_POST['acteur_principal'])) {
                $jouer = new JouerBO();
                $jouer->setIdActeur($_POST['acteur_principal']);
                $jouer->setCodeOeuvre($oeuvre->getCodeOeuvre());
                $jouer->setRoleActeur(1);
                $jouerDAO->createJouer($jouer);
            }

            if (isset($_POST['acteurs']) && is_array($_POST['acteurs'])) {
                foreach ($_POST['acteurs'] as $acteurId) {
                    if ($acteurId != $_POST['acteur_principal']) {
                        $jouer = new JouerBO();
                        $jouer->setIdActeur($acteurId);
                        $jouer->setCodeOeuvre($oeuvre->getCodeOeuvre());
                        $jouer->setRoleActeur(0);
                        $jouerDAO->createJouer($jouer);
                    }
                }
            }

            $realiserDAO = new RealiserDAO($db);
            $realiserDAO->deleteAllByOeuvre($oeuvre->getCodeOeuvre());

            if (isset($_POST['realisateurs']) && is_array($_POST['realisateurs'])) {
                foreach ($_POST['realisateurs'] as $realisateurId) {
                    $realiser = new RealiserBO();
                    $realiser->setIdRealisateur($realisateurId);
                    $realiser->setCodeOeuvre($oeuvre->getCodeOeuvre());
                    $realiserDAO->createRealiser($realiser);
                }
            }

            // Rediriger vers la page de l'œuvre modifiée
            header('Location: /P2025/WEBWORKWELL/oeuvre/voir/' . $oeuvre->getCodeOeuvre());
            exit;
        } else {
            $genreDAO = new GenreDAO($db);
            $classificationDAO = new ClassificationDAO($db);
            $acteurDAO = new ActeurDAO($db);
            $realisateurDAO = new RealisateurDAO($db);

            $genres = $genreDAO->getAllGenres();
            $classifications = $classificationDAO->getAllClassifications();
            $acteurs = $acteurDAO->getAllActeur();
            $realisateurs = $realisateurDAO->getAllRealisateurs();

            $jouerDAO = new JouerDAO($db);
            $acteursAssocies = $jouerDAO->getActeursByOeuvre($oeuvre->getCodeOeuvre());

            $realiserDAO = new RealiserDAO($db);
            $realisateursAssocies = $realiserDAO->getRealisateursByOeuvre($oeuvre->getCodeOeuvre());

            require __DIR__ . '/../../View/Oeuvres/modifierOeuvre.php';
        }
    }
}
