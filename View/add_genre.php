<?php
require_once '../Model/GenreBO.php';
require_once '../Model/GenreDAO.php';
require_once '../database.php';

$database = new Database();
$db = $database->getPDO();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idGenre = $_POST['idGenre'];
    $libelleGenre = $_POST['libelleGenre'];

    $genre = new GenreBO($idGenre, $libelleGenre);
    $genreDAO = new GenreDAO($db);

    if ($genreDAO->createGenre($genre)) {
        echo "Genre ajouté avec succès !";
    } else {
        echo "Erreur lors de l'ajout du genre.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Genre</title>
    <link rel="stylesheet" href="../Style.css">
</head>
<body>
<?php include 'header.php'; ?>
<div class="form-container">
    <h2>Ajouter un Genre</h2>
    <form action="add_genre.php" method="POST" class="add-genre-form">
        <div class="form-group">
            <label for="idGenre">ID Genre:</label>
            <input type="text" id="idGenre" name="idGenre" required>
        </div>
        <div class="form-group">
            <label for="libelleGenre">Libellé:</label>
            <input type="text" id="libelleGenre" name="libelleGenre" required>
        </div>
        <button type="submit" class="form-submit">Ajouter</button>
    </form>
</div>
</body>
</html>
<?php include 'footer.php'; ?>
