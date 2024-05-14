<?php

require_once '../database.php';
require_once '../Model/OeuvreDAO.php';

$oeuvreId = $_GET['id'] ?? null;
if ($oeuvreId === null) {
    echo 'Erreur : aucun ID d\'œuvre fourni.';
    exit();
}

$database = new Database();
$db = $database->getPDO();
$oeuvreDAO = new OeuvreDAO($db);

$result = $oeuvreDAO->deleteOeuvre((int)$oeuvreId);

if ($result) {
    header("Location: accueil.php");
    exit();
} else {
    echo 'Une erreur est survenue lors de la suppression de l\'œuvre.';
}

?>