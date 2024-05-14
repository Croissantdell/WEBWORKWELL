<?php
session_start();

require_once '../Model/OeuvreDAO.php';
require_once '../database.php';


$database = new Database();
$db = $database->getPDO();

$oeuvreDAO = new OeuvreDAO($db);

$codeOeuvre = $_POST['codeOeuvre'] ?? '';
$titreOriginalOeuvre = $_POST['titreOriginalOeuvre'] ?? '';

if ($codeOeuvre && $titreOriginalOeuvre ) {

    $oeuvreDAO->updateOeuvre($codeOeuvre, $titreOriginalOeuvre );

    echo "L'œuvre a été mise à jour avec succès.";
} else {
    echo "Erreur : certaines données du formulaire sont manquantes.";
}

header("Location: oeuvre_detail.php?id=" . $codeOeuvre);