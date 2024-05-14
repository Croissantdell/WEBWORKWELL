<?php
session_start();

if (!isset($_SESSION['idCompte'])) {
    header("Location: login.php");
    exit;
}

require_once '../Model/GenreDAO.php';
require_once '../database.php';

$database = new Database();
$db = $database->getPDO();

$genreDAO = new GenreDAO($db);

$idGenre = $_GET['id'] ?? '';
if (!$idGenre) {
    echo "Aucun genre spécifié pour la modification.";
    exit;
}

$genre = $genreDAO->getGenreById($idGenre);
if (!$genre) {
    echo "Genre introuvable.";
    exit;
}

$libelleGenre = $genre['libelleGenre'] ?? '';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Genre</title>
    <link rel="stylesheet" href="../Style.css">
</head>
<body>
<?php include 'header.php'; ?>
<main>
    <h1>Modifier le Genre</h1>
    <form method="post" action="update_genre.php">
        <input type="hidden" name="idGenre" value="<?= htmlspecialchars($idGenre); ?>">

        <label for="libelleGenre">Libellé du Genre:</label>
        <input type="text" id="libelleGenre" name="libelleGenre" value="<?= htmlspecialchars($libelleGenre); ?>" required><br>

        <input type="submit" value="Modifier le Genre">
    </form>
</main>
</body>
</html>
<?php include 'footer.php'; ?>
