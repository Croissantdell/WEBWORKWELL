<?php
session_start();

if (!isset($_SESSION['idCompte'])) {
    header("Location: login.php");
    exit;
}

require_once '../Model/ActeurDAO.php';
require_once '../database.php';

$database = new Database();
$db = $database->getPDO();

$acteurDAO = new ActeurDAO($db);

$idActeur = $_GET['id'] ?? '';
if (!$idActeur) {
    echo "Aucun acteur spécifié pour la modification.";
    exit;
}

$acteur = $acteurDAO->getActorById($idActeur);
if (!$acteur) {
    echo "Acteur introuvable.";
    exit;
}

$nomActeur = $acteur['nomActeur'] ?? '';
$prenomActeur = $acteur['prenomActeur'] ?? '';
$nationaliteActeur = $acteur['nationaliteActeur'] ?? '';
$dateNaissanceActeur = $acteur['dateNaissanceActeur'] ?? '';
$photo = $acteur['photo'] ?? '';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'Acteur</title>
    <link rel="stylesheet" href="../Style.css">
</head>
<body>
<?php include 'header.php'; ?>
<main>
    <h1>Modifier l'Acteur</h1>
    <form method="post" action="update_acteur.php" enctype="multipart/form-data">
        <input type="hidden" name="idActeur" value="<?= htmlspecialchars($idActeur); ?>">

        <label for="nomActeur">Nom:</label>
        <input type="text" id="nomActeur" name="nomActeur" value="<?= htmlspecialchars($nomActeur); ?>" required><br>

        <label for="prenomActeur">Prénom:</label>
        <input type="text" id="prenomActeur" name="prenomActeur" value="<?= htmlspecialchars($prenomActeur); ?>" required><br>

        <label for="nationaliteActeur">Nationalité:</label>
        <input type="text" id="nationaliteActeur" name="nationaliteActeur" value="<?= htmlspecialchars($nationaliteActeur); ?>" required><br>

        <label for="dateNaissanceActeur">Date de Naissance:</label>
        <input type="date" id="dateNaissanceActeur" name="dateNaissanceActeur" value="<?= htmlspecialchars($dateNaissanceActeur); ?>" required><br>

        <label for="photo">Photo:</label>
        <input type="file" id="photo" name="photo"><br>

        <input type="submit" value="Modifier l'Acteur">
    </form>
</main>
</body>
</html>
<?php include 'footer.php'; ?>
