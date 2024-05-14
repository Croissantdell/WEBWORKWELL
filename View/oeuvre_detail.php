<?php
require_once '../database.php';
require_once '../Model/OeuvreDAO.php';
require_once '../Model/ActeurDAO.php';
require_once '../Model/RealisateurDAO.php';
require_once '../Model/ClassificationDAO.php';
require_once '../Model/GenreDAO.php';

$oeuvreId = $_GET['id'] ?? '';

$database = new Database();
$db = $database->getPDO();

$oeuvreDAO = new OeuvreDAO($db);
$acteurDAO = new ActeurDAO($db);
$realisateurDAO = new RealisateurDAO($db);
$classificationDAO = new ClassificationDAO($db);
$genreDAO = new GenreDAO($db);

$oeuvre = $oeuvreDAO->getOeuvreById($oeuvreId);

$actors = $director = $classifications = $genres = null;

if ($oeuvre) {
    $actors = $acteurDAO->getActorsByOeuvre($oeuvreId);
    $director = $realisateurDAO->getRealisateurByOeuvre($oeuvreId);
    $classifications = $classificationDAO->getClassificationsByOeuvre($oeuvreId);
    $genres = $genreDAO->getGenresByOeuvre($oeuvreId);
}

function cleanData($data) {
    return $data ? htmlspecialchars($data) : "";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail de l'Œuvre: <?= cleanData($oeuvre->getTitreFrancaisOeuvre() ?? ''); ?></title>
    <link rel="stylesheet" href="../Style.css">
</head>
<body>
<header>
    <?php include 'header.php'; ?>
</header>
<main>
    <?php if ($oeuvre): ?>
        <h1 class="oeuvre-heading">
            <?= cleanData($oeuvre->getTitreFrancaisOeuvre()); ?>
            <?php if (isset($_SESSION['idCompte']) && $_SESSION['idCompte']): ?>
                <a href="edit_oeuvre.php?id=<?= cleanData($oeuvre->getCodeOeuvre()); ?>">Modifier</a>
                <a href="delete_oeuvre.php?id=<?= cleanData($oeuvre->getCodeOeuvre()); ?>">Supprimer</a>
            <?php endif; ?>
        </h1>
        <div class="oeuvre-details">
            <img src="<?= cleanData($oeuvre->getAffiche()); ?>" alt="Affiche de <?= cleanData($oeuvre->getTitreFrancaisOeuvre()); ?>">
            <div>
                <h2><?= cleanData($oeuvre->getTitreFrancaisOeuvre()); ?></h2>
                <p><strong>Titre Original:</strong> <?= cleanData($oeuvre->getTitreOriginalOeuvre()); ?></p>
                <p><strong>Année de sortie:</strong> <?= cleanData($oeuvre->getAnneeSortieOeuvre()); ?></p>
                <p><strong>Résumé:</strong> <?= cleanData($oeuvre->getResumeOeuvre()); ?></p>
                <?php if (!is_null($oeuvre->getNbEpisodeOeuvre())): ?>
                    <p><strong>Nombre d'épisodes:</strong> <?= cleanData($oeuvre->getNbEpisodeOeuvre()); ?></p>
                <?php endif; ?>
                <?php if ($classifications): ?>
                    <p><strong>Classifications :</strong>
                        <?php foreach ($classifications as $classification): ?>
                            <?= cleanData($classification->getLibelleClassification()); ?>
                        <?php endforeach; ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
        <section class="section">
            <h2 class="section-title">Acteurs</h2>
            <?php if ($actors): foreach ($actors as $actor): ?>
                <p>
                    <a href="actor_detail.php?id=<?= cleanData($actor['idActeur']); ?>" class="section-link">
                        <?= cleanData($actor['prenomActeur']) . ' ' . cleanData($actor['nomActeur']); ?>
                    </a>
                    - <span class="section-text"><?= $actor['roleActeur'] ? 'Principal' : 'Secondaire'; ?></span>
                </p>
            <?php endforeach; endif; ?>
        </section>
        <section class="section">
            <h2 class="section-title">Genres</h2>
            <?php if ($genres): foreach ($genres as $genre): ?>
                <p class="section-text"><?= cleanData($genre['libelleGenre']); ?></p>
            <?php endforeach; endif; ?>
        </section>
        <section class="section">
            <h2 class="section-title">Réalisateur</h2>
            <?php if ($director): ?>
                <p class="section-text"><?= cleanData($director['prenomRealisateur']) . ' ' . cleanData($director['nomRealisateur']); ?></p>
            <?php endif; ?>
        </section>
    <?php else: ?>
        <p>Cette œuvre n'existe pas.</p>
    <?php endif; ?>
</main>
<footer>
    <?php include 'footer.php'; ?>
</footer>
</body>
</html>
