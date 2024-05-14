<?php
session_start();

if (!isset($_SESSION['idCompte'])) {
    header("Location: login.php");
}

require_once '../Model/OeuvreDAO.php';
require_once '../Model/ActeurDAO.php';
require_once '../Model/RealisateurDAO.php';
require_once '../Model/GenreDAO.php';
require_once '../Model/ClassificationDAO.php';
require_once '../database.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$database = new Database();
$db = $database->getPDO();

$acteurDAO = new ActeurDAO($db);
$realisateurDAO = new RealisateurDAO($db);
$genreDAO = new GenreDAO($db);
$classificationDAO = new ClassificationDAO($db);

$acteurs = $acteurDAO->getAllActeurs();
$realisateurs = $realisateurDAO->getAllRealisateurs();
$genres = $genreDAO->getAllGenres();
$classifications = $classificationDAO->getAllClassifications();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projet PHP - Ajouter une œuvre</title>
    <link rel="stylesheet" href="../Style.css">
</head>
<body>
<header>
    <?php

    include 'header.php';
    ?></header>
<main>
    <h1>Ajouter une œuvre</h1>
    <form method="post" action="add_oeuvre.php" enctype="multipart/form-data">
        <label for="titreOriginalOeuvre">Titre Original:</label>
        <input type="text" id="titreOriginalOeuvre" name="titreOriginalOeuvre"><br>

        <label for="titreFrancaisOeuvre">Titre Français:</label>
        <input type="text" id="titreFrancaisOeuvre" name="titreFrancaisOeuvre"><br>

        <label for="nomActeurPrincipal">Acteur Principal:</label>
        <select id="nomActeurPrincipal" name="nomActeurPrincipal">
            <?php foreach ($acteurs as $acteur): ?>
                <option value="<?= $acteur['idActeur']; ?>"><?= $acteur['nomActeur']; ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="nomActeur">Autres acteurs:</label>
        <select id="nomActeur" name="nomActeur[]" multiple>
            <?php foreach ($acteurs as $acteur): ?>
                <option value="<?= $acteur['idActeur']; ?>"><?= $acteur['nomActeur']; ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="nomRealisateur">Réalisateur:</label>
        <select id="nomRealisateur" name="nomRealisateur[]" multiple>
            <?php foreach ($realisateurs as $realisateur): ?>
                <option value="<?= $realisateur['idRealisateur']; ?>"><?= $realisateur['nomRealisateur']; ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="idGenre">Genre:</label>
        <select id="idGenre" name="idGenre">
            <?php foreach ($genres as $genre) : ?>
                <option value="<?= $genre['idGenre']; ?>"><?= $genre['libelleGenre']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="codeClassification">Classification:</label>
        <select id="codeClassification" name="codeClassification">
            <?php foreach ($classifications as $classification) : ?>
                <option value="<?= $classification['codeClassification']; ?>"><?= $classification['libelleClassification']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="anneeSortieOeuvre">Année de sortie:</label>
        <input type="number" id="anneeSortieOeuvre" name="anneeSortieOeuvre"><br>

        <label for="resumerOeuvre">Résumé:</label>
        <textarea id="resumerOeuvre" name="resumerOeuvre"></textarea><br>

        <label for="nbEpisodeOeuvre">Nombre d'épisodes:</label>
        <input type="number" id="nbEpisodeOeuvre" name="nbEpisodeOeuvre"><br>

        <label for="image">Affiche du film :</label>
        <input type="file" id="image" name="image"><br>

        <input type="submit" value="Ajouter l'œuvre">
    </form>
</main>
</body>
</html>
<?php include 'footer.php'; ?>
