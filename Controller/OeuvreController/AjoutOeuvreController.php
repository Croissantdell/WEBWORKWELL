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

class AjoutOeuvreController {
    public function ajouterOeuvre() {


        $database = new Database();
        $db = $database->getConnection();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $oeuvreDAO = new OeuvreDAO($db);
            $oeuvre = new OeuvreBO();
            $oeuvre->setTitreOriginalOeuvre($_POST['titre_original']);
            $oeuvre->setTitreFrancaisOeuvre($_POST['titre_francais']);
            $oeuvre->setAnneeSortieOeuvre($_POST['annee_sortie']);
            $oeuvre->setResumeOeuvre($_POST['resume']);
            $oeuvre->setNbEpisodeOeuvre($_POST['nb_episodes']);
            $oeuvre->setCodeClassification($_POST['code_classification']);
            $oeuvre->setIdGenre($_POST['id_genre']);

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
                } else {
                    $oeuvre->setAffiche(null);
                }
            } else {
                $oeuvre->setAffiche(null);
            }

            $oeuvreDAO->createOeuvre($oeuvre);

            $jouerDAO = new JouerDAO($db);
            if (isset($_POST['acteur_principal'])) {
                $jouer = new JouerBO();
                $jouer->setIdActeur($_POST['acteur_principal']);
                $jouer->setCodeOeuvre($oeuvre->getCodeOeuvre());
                $jouer->setRoleActeur(1);
                $jouerDAO->createJouer($jouer);
            }

            if (isset($_POST['acteurs']) && is_array($_POST['acteurs'])) {
                foreach ($_POST['acteurs'] as $acteurId) {
                    // Éviter d'ajouter l'acteur principal deux fois
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
            if (isset($_POST['realisateurs']) && is_array($_POST['realisateurs'])) {
                foreach ($_POST['realisateurs'] as $realisateurId) {
                    $realiser = new RealiserBO();
                    $realiser->setIdRealisateur($realisateurId);
                    $realiser->setCodeOeuvre($oeuvre->getCodeOeuvre());
                    $realiserDAO->createRealiser($realiser);
                }
            }

            header('Location: /P2025/WEBWORKWELL/oeuvre/voir/' . $oeuvre->getCodeOeuvre());
        } else {
            $genreDAO = new GenreDAO($db);
            $classificationDAO = new ClassificationDAO($db);
            $acteurDAO = new ActeurDAO($db);
            $realisateurDAO = new RealisateurDAO($db);

            $genres = $genreDAO->getAllGenres();
            $classifications = $classificationDAO->getAllClassifications();
            $acteurs = $acteurDAO->getAllActeur();
            $realisateurs = $realisateurDAO->getAllRealisateurs();

            require __DIR__ . '/../../View/Oeuvres/ajouterOeuvre.php';
        }
    }
}

