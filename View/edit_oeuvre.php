<?php
session_start();

if (!isset($_SESSION['idCompte'])) {
    header("Location: login.php");
    exit;
}

require_once '../Model/OeuvreDAO.php';
require_once '../Model/ActeurDAO.php';
require_once '../Model/RealisateurDAO.php';
require_once '../Model/GenreDAO.php';
require_once '../Model/ClassificationDAO.php';
require_once '../database.php';

$codeOeuvre = $_GET['id'] ?? '';
if (!$codeOeuvre) {
    echo "Aucune œuvre n'a été spécifiée pour la modification.";
    exit;
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

$database = new Database();
$db = $database->getPDO();

$oeuvreDAO = new OeuvreDAO($db);
$acteurDAO = new ActeurDAO($db);
$realisateurDAO = new RealisateurDAO($db);
$genreDAO = new GenreDAO($db);
$classificationDAO = new ClassificationDAO($db);

$oeuvre = $oeuvreDAO->getOeuvreById($codeOeuvre);

$titreOriginalOeuvre = $oeuvre->getTitreOriginalOeuvre() ?? '';
$titreFrancaisOeuvre = $oeuvre->getTitreFrancaisOeuvre() ?? '';
$anneeSortieOeuvre = $oeuvre->getAnneeSortieOeuvre() ?? '';

$acteurs = $acteurDAO->getAllActeurs();
$realisateurs = $realisateurDAO->getAllRealisateurs();
$genres = $genreDAO->getAllGenres();
$classifications = $classificationDAO->getAllClassifications();

$associatedActors = $acteurDAO->getActorsByOeuvre($codeOeuvre);
$associatedDirectors = $realisateurDAO->getRealisateursByOeuvre($codeOeuvre);
$associatedGenres = $genreDAO->getGenresByOeuvre($codeOeuvre);
$associatedClassifications = $classificationDAO->getClassificationsByOeuvre($codeOeuvre);

$associatedClassificationCodes = array_map(function($classification) {
    return $classification->getCodeClassification();
}, $associatedClassifications);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une œuvre</title>
    <link rel="stylesheet" href="../Style.css">
</head>
<body>
<?php include 'header.php'; ?>
<main>
    <h1>Modifier une œuvre</h1>
    <form method="post" action="update_oeuvre.php" enctype="multipart/form-data">
        <input type="hidden" name="codeOeuvre" value="<?= htmlspecialchars($codeOeuvre); ?>">

        <label for="titreOriginalOeuvre">Titre Original:</label>
        <input type="text" id="titreOriginalOeuvre" name="titreOriginalOeuvre" value="<?= htmlspecialchars($titreOriginalOeuvre); ?>"><br>

        <label for="titreFrancaisOeuvre">Titre Français:</label>
        <input type="text" id="titreFrancaisOeuvre" name="titreFrancaisOeuvre" value="<?= htmlspecialchars($titreFrancaisOeuvre); ?>"><br>

        <label for="anneeSortieOeuvre">Année de sortie:</label>
        <input type="text" id="anneeSortieOeuvre" name="anneeSortieOeuvre" value="<?= htmlspecialchars($anneeSortieOeuvre); ?>"><br>

        <label for="resumeOeuvre">Résumé de l'œuvre :</label>
        <textarea id="resumeOeuvre" name="resumeOeuvre"><?= htmlspecialchars($oeuvre->getResumeOeuvre() ?? ''); ?></textarea><br>

        <label for="nbEpisodeOeuvre">Nombre d'épisodes :</label>
        <input type="text" id="nbEpisodeOeuvre" name="nbEpisodeOeuvre" value="<?= htmlspecialchars($oeuvre->getNbEpisodeOeuvre() ?? ''); ?>"><br>

        <label for="affiche">Affiche actuelle:</label>
        <img src="<?= htmlspecialchars($oeuvre->getAffiche() ?? ''); ?>" alt="Affiche actuelle"><br>

        <label for="affiche">Changer d'affiche (laisser vide pour ne pas changer):</label>
        <input type="file" id="affiche" name="affiche"><br>

        <label for="acteurs">Acteurs:</label>
        <select id="acteurs" name="acteurs[]" multiple>
            <?php foreach ($acteurs as $acteur): ?>
                <option value="<?= htmlspecialchars($acteur['idActeur']); ?>" <?= in_array($acteur['idActeur'], array_column($associatedActors, 'idActeur')) ? "selected" : ""; ?>>
                    <?= htmlspecialchars($acteur['nomActeur']); ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label for="realisateurs">Réalisateurs:</label>
        <select id="realisateurs" name="realisateurs[]" multiple>
            <?php foreach ($realisateurs as $realisateur): ?>
                <option value="<?= htmlspecialchars($realisateur['idRealisateur']); ?>" <?= in_array($realisateur['idRealisateur'], array_column($associatedDirectors, 'idRealisateur')) ? "selected" : ""; ?>>
                    <?= htmlspecialchars($realisateur['nomRealisateur']); ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label for="genres">Genres:</label>
        <select id="genres" name="genres[]" multiple>
            <?php foreach ($genres as $genre): ?>
                <option value="<?= htmlspecialchars($genre['idGenre']); ?>" <?= in_array($genre['idGenre'], array_column($associatedGenres, 'idGenre')) ? "selected" : ""; ?>>
                    <?= htmlspecialchars($genre['libelleGenre']); ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label for="classifications">Classifications:</label>
        <select id="classifications" name="classifications[]" multiple>
            <?php foreach ($classifications as $classification): ?>
                <option value="<?= htmlspecialchars($classification->getCodeClassification()); ?>" <?= in_array($classification->getCodeClassification(), $associatedClassificationCodes) ? "selected" : ""; ?>>
                    <?= htmlspecialchars($classification->getLibelleClassification()); ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <input type="submit" value="Modifier l'œuvre">
    </form>
</main>
</body>
</html>
<?php include 'footer.php'; ?>
