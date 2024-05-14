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
$genres = $genreDAO->getAllGenres();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Genres</title>
    <link rel="stylesheet" href="../Style.css">
</head>
<body>
<?php include 'header.php'; ?>
<main>
    <h1>Liste des Genres</h1>
    <?php if (isset($_SESSION['message'])): ?>
        <p><?= $_SESSION['message']; unset($_SESSION['message']); ?></p>
    <?php endif; ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Libellé</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($genres as $genre): ?>
            <tr>
                <td><?= htmlspecialchars($genre['idGenre']); ?></td>
                <td><?= htmlspecialchars($genre['libelleGenre']); ?></td>
                <td>
                    <a href="edit_genre.php?id=<?= htmlspecialchars($genre['idGenre']); ?>">Modifier</a>
                    <a href="delete_genre.php?id=<?= htmlspecialchars($genre['idGenre']); ?>">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="add_genre.php">Ajouter un nouveau genre</a>
</main>
</body>
</html>
<?php include 'footer.php'; ?>
