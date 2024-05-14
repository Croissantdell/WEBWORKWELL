<?php
session_start();

require_once '../Model/OeuvreDAO.php';
require_once '../Model/ActeurDAO.php';
require_once '../Model/RealisateurDAO.php';
require_once '../Model/GenreDAO.php';
require_once '../Model/ClassificationDAO.php';
require_once '../database.php';
if (!isset($_SESSION['idCompte'])) {
    header("Location: login.php");
}
$database = new Database();
$db = $database->getPDO();

$oeuvreDAO = new OeuvreDAO($db);
$acteurDAO = new ActeurDAO($db);
$realisateurDAO = new RealisateurDAO($db);
$genreDAO = new GenreDAO($db);
$classificationDAO = new ClassificationDAO($db);

$titreOriginalOeuvre = $_POST['titreOriginalOeuvre'] ?? '';
$titreFrancaisOeuvre = $_POST['titreFrancaisOeuvre'] ?? '';
$anneeSortieOeuvre = $_POST['anneeSortieOeuvre'] ?? '';
$resumerOeuvre = $_POST['resumerOeuvre'] ?? '';
$nbEpisodeOeuvre = $_POST['nbEpisodeOeuvre'] ?? '';
$realisateurIds = $_POST['nomRealisateur'] ?? [];
$acteurPrincipalId = $_POST['nomActeurPrincipal'] ?? '';
$acteurIds = $_POST['nomActeur'] ?? [];
$idGenre = $_POST['idGenre'] ?? '';
$codeClassification = $_POST['codeClassification'] ?? '';
$uploadDir = '../Image/';
$acteurIds = array_unique(array_merge([$acteurPrincipalId], $acteurIds));

function uploadFile($uploadDir, $file)
{
    if (isset($_FILES[$file]) && $_FILES[$file]['error'] == UPLOAD_ERR_OK) {
        $uploadFile = $uploadDir . basename($_FILES[$file]['name']);
        if (move_uploaded_file($_FILES[$file]['tmp_name'], $uploadFile)) {
            return $uploadFile;
        }
    }
    return false;
}

$uploadImageFile = uploadFile($uploadDir, 'image');

if ( $uploadImageFile && $titreOriginalOeuvre && $titreFrancaisOeuvre && $anneeSortieOeuvre && $resumerOeuvre && $nbEpisodeOeuvre && !empty($realisateurIds) && !empty($acteurIds)) {
    $codeOeuvre = $oeuvreDAO->createOeuvre($titreOriginalOeuvre, $titreFrancaisOeuvre, $anneeSortieOeuvre, $resumerOeuvre, $nbEpisodeOeuvre, $uploadImageFile);

    foreach ($realisateurIds as $idRealisateur) {
        $realisateurDAO->associerOeuvre($idRealisateur, $codeOeuvre);
    }

    foreach ($acteurIds as $idActeur) {
        $isMainActor = $idActeur === $acteurPrincipalId ? 1 : 0;
        $acteurDAO->associerOeuvre($idActeur, $codeOeuvre, $isMainActor);
    }

    $oeuvreDAO->associerGenre($idGenre, $codeOeuvre);
    $oeuvreDAO->associerClassification($codeClassification, $codeOeuvre);

    echo "L'œuvre a bien été ajoutée.";

} else {
    echo "L'œuvre n'a pas été ajoutée : il manque des informations.";
}

header("Location: oeuvre_detail.php?id=" . $codeOeuvre);