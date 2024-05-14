<?php
require_once '../Model/ActeurBO.php';
require_once '../Model/ActeurDAO.php';
require_once '../database.php';
session_start();

if (!isset($_SESSION['idCompte'])) {
    header("Location: login.php");
}

$database = new Database();
$db = $database->getPDO();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idActeur = $_POST['idActeur'];
    $nomActeur = $_POST['nomActeur'];
    $prenomActeur = $_POST['prenomActeur'];
    $nationaliteActeur = $_POST['nationaliteActeur'];
    $dateNaissanceActeur = $_POST['dateNaissanceActeur'];
    $photo = $_POST['photo'];

    $acteur = new ActeurBO($idActeur, $nomActeur, $prenomActeur, $nationaliteActeur, $dateNaissanceActeur, $photo);
    $acteurDAO = new ActeurDAO($db);

    if ($acteurDAO->createActeur($acteur)) {
        echo "Acteur ajouté avec succès !";
    } else {
        echo "Erreur lors de l'ajout de l'acteur.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Acteur</title>
    <link rel="stylesheet" href="../Style.css">
</head>
<body>
<?php include 'header.php'; ?>
<div class="form-container">
    <h2>Ajouter un Acteur</h2>
    <form action="add_acteur.php" method="POST" class="add-acteur-form">
        <div class="form-group">
            <label for="idActeur">ID Acteur:</label>
            <input type="text" id="idActeur" name="idActeur" required>
        </div>
        <div class="form-group">
            <label for="nomActeur">Nom:</label>
            <input type="text" id="nomActeur" name="nomActeur" required>
        </div>
        <div class="form-group">
            <label for="prenomActeur">Prénom:</label>
            <input type="text" id="prenomActeur" name="prenomActeur" required>
        </div>
        <div class="form-group">
            <label for="nationaliteActeur">Nationalité:</label>
            <input type="text" id="nationaliteActeur" name="nationaliteActeur" required>
        </div>
        <div class="form-group">
            <label for="dateNaissanceActeur">Date de Naissance:</label>
            <input type="date" id="dateNaissanceActeur" name="dateNaissanceActeur" required>
        </div>
        <div class="form-group">
            <label for="photo">Photo URL:</label>
            <input type="text" id="photo" name="photo" required>
        </div>
        <button type="submit" class="form-submit">Ajouter</button>
    </form>
</div>
</body>
</html>
<?php include 'footer.php'; ?>
