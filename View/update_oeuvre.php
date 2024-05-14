<?php
session_start();

require_once '../Model/OeuvreDAO.php';
require_once '../database.php';

$database = new Database();
$db = $database->getPDO();
$oeuvreDAO = new OeuvreDAO($db);

$codeOeuvre = $_POST['codeOeuvre'] ?? '';
$titreOriginalOeuvre = $_POST['titreOriginalOeuvre'] ?? '';
$titreFrancaisOeuvre = $_POST['titreFrancaisOeuvre'] ?? '';
$anneeSortieOeuvre = $_POST['anneeSortieOeuvre'] ?? '';
$resumeOeuvre = $_POST['resumeOeuvre'] ?? '';
$nbEpisodeOeuvre = $_POST['nbEpisodeOeuvre'] ?? '';
$acteurs = $_POST['acteurs'] ?? [];
$realisateurs = $_POST['realisateurs'] ?? [];
$genres = $_POST['genres'] ?? [];
$classifications = $_POST['classifications'] ?? [];

$uploadDir = '../image/';

function uploadFile($uploadDir, $file)
{
    if (isset($_FILES[$file]) && $_FILES[$file]['error'] === UPLOAD_ERR_OK) {
        $uploadFile = $uploadDir . basename($_FILES[$file]['name']);
        if (move_uploaded_file($_FILES[$file]['tmp_name'], $uploadFile)) {
            return $uploadFile;
        } else {
            echo "Erreur lors de l'upload du fichier.";
        }
    }
    return false;
}

$affiche = uploadFile($uploadDir, 'affiche');

if ($codeOeuvre && $titreOriginalOeuvre && $titreFrancaisOeuvre && $anneeSortieOeuvre) {
    $oeuvre = $oeuvreDAO->getOeuvreById($codeOeuvre);

    if (!$affiche) {
        $affiche = $oeuvre->getAffiche();
    }

    $nbEpisodeOeuvre = ($nbEpisodeOeuvre === '') ? null : (int)$nbEpisodeOeuvre;

    $oeuvre->setTitreOriginalOeuvre($titreOriginalOeuvre);
    $oeuvre->setTitreFrancaisOeuvre($titreFrancaisOeuvre);
    $oeuvre->setAnneeSortieOeuvre($anneeSortieOeuvre);
    $oeuvre->setResumeOeuvre($resumeOeuvre);
    $oeuvre->setNbEpisodeOeuvre($nbEpisodeOeuvre);
    $oeuvre->setAffiche($affiche);

    $oeuvreDAO->updateOeuvre(
        $oeuvre->getCodeOeuvre(),
        $oeuvre->getTitreOriginalOeuvre(),
        $oeuvre->getTitreFrancaisOeuvre(),
        $oeuvre->getAnneeSortieOeuvre(),
        $oeuvre->getResumeOeuvre(),
        $oeuvre->getNbEpisodeOeuvre(),
        $oeuvre->getAffiche(),
        $acteurs,
        $realisateurs,
        $genres,
        $classifications
    );

    echo "L'œuvre a été mise à jour avec succès.";
} else {
    echo "Erreur : certaines données du formulaire sont manquantes.";
}

header("Location: oeuvre_detail.php?id=" . $codeOeuvre);
exit;
?>
