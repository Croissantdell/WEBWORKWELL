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

$codeOeuvre = $_GET['id'] ?? '';
if (!$codeOeuvre) {
    echo "Aucune oeuvre n'a été spécifiée pour la modification.";
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

$titreOriginalOeuvre = $oeuvre->getTitreOriginalOeuvre();
$titreFrancaisOeuvre = $oeuvre->getTitreFrancaisOeuvre();
$anneeSortieOeuvre = $oeuvre->getAnneeSortieOeuvre();

$acteurs = $acteurDAO->getAllActeurs();
$realisateurs = $realisateurDAO->getAllRealisateurs();
$genres = $genreDAO->getAllGenres();
$classifications = $classificationDAO->getAllClassifications();

$associatedActors = $acteurDAO->getActorsByOeuvre($codeOeuvre);
$associatedDirectors = $realisateurDAO->getRealisateurByOeuvre($codeOeuvre);
$associatedGenres = $genreDAO->getGenresByOeuvre($codeOeuvre);
$associatedClassifications = $classificationDAO->getClassificationByOeuvre($codeOeuvre);

?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Projet PHP - Modifier une œuvre</title>
        <link rel="stylesheet" href="../Style.css">
    </head>
    <body>
    <header>
        <?php include 'header.php'; ?>
    </header>
    <main>
        <h1 class="Msgoeuvre">Modifier des Oeuvres</h1>
        <hr>
        <form method="post" action="update_oeuvre.php" enctype="multipart/form-data">
            <input type="hidden" name="codeOeuvre" value="<?= $codeOeuvre; ?>">

            <div class="column-container">
                <div class="column left">
                    <label class="label-above-input" for="titreOriginalOeuvre">Titre Original:</label>
                    <input type="text" id="titreOriginalOeuvre" name="titreOriginalOeuvre" value="<?= $oeuvre->titreOriginalOeuvre ?>">
                </div>
                <div class="column right">
                    <label class="label-above-input" for="titreFrancaisOeuvre">Titre Francais:</label>
                    <input type="text" id="titreFrancaisOeuvre" name="titreFrancaisOeuvre" value="<?= $oeuvre->titreFrancaisOeuvre ?>">
                </div>

                <div class="column right">
                    <label class="label-above-input" for="anneeSortieOeuvre">Année de sortie:</label>
                    <input type="text" id="anneeSortieOeuvre" name="anneeSortieOeuvre" value="<?= $oeuvre->anneeSortieOeuvre ?>">
                </div>
                <div class="column left">
                    <label class="label-above-input" for="resumeOeuvre">Résumé de l'œuvre :</label>
                    <textarea id="resumeOeuvre" name="resumeOeuvre" class="left-column"><?= $oeuvre->resumeOeuvre ?></textarea>
                </div>

                <div class="column right">
                    <label class="label-above-input" for="nbEpisodeOeuvre">Nombre d'épisode :</label>
                    <input type="text" id="nbEpisodeOeuvre" name="nbEpisodeOeuvre" value="<?= $oeuvre->nbEpisodeOeuvre ?>">
                </div>

                <div class="column left">
                    <label class="label-above-input" for="acteurs">Acteurs:</label>
                    <select id="acteurs" name="acteurs[]" multiple>
                        <?php foreach ($acteurs as $acteur): ?>
                            <option value="<?= $acteur['idActeur']; ?>"
                                <?php if (in_array($acteur['idActeur'], $associatedActors)) echo "selected"; ?>>
                                <?= $acteur['nomActeur']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <label class="label-above-input" for="affiche">Affiche:</label>
                <label class="label-above-input" for="affiche">Affiche:</label>
                <input type="file" id="affiche" name="affiche">
            </div>
            </div>


            <input type="submit" value="Modifier l'œuvre">
        </form>
    </main>
    </body>
    </html>
<?php include 'footer.php'; ?>S