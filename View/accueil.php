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
                <div class="oeuvre">
                    <a href="oeuvre_detail.php?id=<?= htmlspecialchars($oeuvre['codeOeuvre']); ?>">
                        <img src="<?= htmlspecialchars($oeuvre['affiche']); ?>"
                             alt="<?= htmlspecialchars($oeuvre['titreFrancaisOeuvre']); ?>">
                        <h3><?= htmlspecialchars($oeuvre['titreFrancaisOeuvre']); ?></h3>
                    </a>
                    <p><img src="../image/per.png" alt="Logo-Réalisateur" class="icon">
                        <?= htmlspecialchars($director['prenomRealisateur']) . ' ' . htmlspecialchars($director['nomRealisateur']); ?>
                    </p>
                    <p><img src="../image/lib.png" alt="Logo-Genre" class="icon">
                        <?php foreach ($genres as $genre) { echo htmlspecialchars($genre['libelleGenre']) . ', '; } ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>
</body>
</html>
<?php include 'footer.php'; ?>
