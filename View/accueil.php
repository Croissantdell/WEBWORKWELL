<?php
require_once '../database.php';
require_once '../Model/OeuvreDAO.php';
require_once '../Model/RealisateurDAO.php';
require_once '../Model/GenreDAO.php';

$database = new Database();
$db = $database->getPDO();

$oeuvreDAO = new OeuvreDAO($db);
$latestOeuvres = $oeuvreDAO->getLatestOeuvres();

$realisateurDAO = new RealisateurDAO($db);
$genreDAO = new GenreDAO($db);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Cinémathèque</title>
    <link rel="stylesheet" href="../Style.css">
</head>
<body>
<?php include 'header.php'; ?>
<main>
    <section id="welcome">
        <h2>Découvrez les dernières œuvres</h2>
        <div class="oeuvres-container">
            <?php foreach ($latestOeuvres as $oeuvre):
                $director = $realisateurDAO->getRealisateurByOeuvre($oeuvre['codeOeuvre']);
                $genres = $genreDAO->getGenresByOeuvre($oeuvre['codeOeuvre']);
                ?>
                <div class="oeuvre-card">
                    <a href="oeuvre_detail.php?id=<?= htmlspecialchars($oeuvre['codeOeuvre']); ?>" class="oeuvre-link">
                        <img src="<?= htmlspecialchars($oeuvre['affiche']); ?>" alt="<?= htmlspecialchars($oeuvre['titreFrancaisOeuvre']); ?>" class="oeuvre-img">
                        <h3 class="oeuvre-title"><?= htmlspecialchars($oeuvre['titreFrancaisOeuvre']); ?></h3>
                    </a>
                    <p class="oeuvre-director">
                        <img src="../image/per.png" alt="Logo-Réalisateur" class="icon">
                        <?= htmlspecialchars($director['prenomRealisateur']) . ' ' . htmlspecialchars($director['nomRealisateur']); ?>
                    </p>
                    <p class="oeuvre-genres">
                        <img src="../image/lib.png" alt="Logo-Genre" class="icon">
                        <?php foreach ($genres as $genre): ?>
                            <?= htmlspecialchars($genre['libelleGenre']) . ', '; ?>
                        <?php endforeach; ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>
<?php include 'footer.php'; ?>
</body>
