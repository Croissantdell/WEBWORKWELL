<?php
require_once '../Model/RealisateurBO.php';
require_once '../Model/RealisateurDAO.php';
require_once '../database.php';
session_start();

if (!isset($_SESSION['idCompte'])) {
    header("Location: login.php");
}
$database = new Database();
$db = $database->getPDO();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idRealisateur = $_POST['idRealisateur'];
    $nomRealisateur = $_POST['nomRealisateur'];
    $prenomRealisateur = $_POST['prenomRealisateur'];
    $nationaliteRealisateur = $_POST['nationaliteRealisateur'];
    $recompenseRealisateur = $_POST['recompenseRealisateur'];
    $photo = $_POST['photo'];

    $realisateur = new RealisateurBO($idRealisateur, $nomRealisateur, $prenomRealisateur, $nationaliteRealisateur, $recompenseRealisateur, $photo);
    $realisateurDAO = new RealisateurDAO($db);

    if ($realisateurDAO->createRealisateur($realisateur)) {
        echo "Realisateur ajouté avec succès !";
    } else {
        echo "Erreur lors de l'ajout du realisateur.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Realisateur</title>
    <link rel="stylesheet" href="../Style.css">
</head>
<body>
<?php include 'header.php'; ?>
<div class="form-container">
    <h2>Ajouter un Realisateur</h2>
    <form action="add_realisateur.php" method="POST" class="add-realisateur-form">
        <div class="form-group">
            <label for="idRealisateur">ID Realisateur:</label>
            <input type="text" id="idRealisateur" name="idRealisateur" required>
        </div>
        <div class="form-group">
            <label for="nomRealisateur">Nom:</label>
            <input type="text" id="nomRealisateur" name="nomRealisateur" required>
        </div>
        <div class="form-group">
            <label for="prenomRealisateur">Prénom:</label>
            <input type="text" id="prenomRealisateur" name="prenomRealisateur" required>
        </div>
        <div class="form-group">
            <label for="nationaliteRealisateur">Nationalité:</label>
            <input type="text" id="nationaliteRealisateur" name="nationaliteRealisateur" required>
        </div>
        <div class="form-group">
            <label for="recompenseRealisateur">Récompenses:</label>
            <input type="number" id="recompenseRealisateur" name="recompenseRealisateur" required>
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
