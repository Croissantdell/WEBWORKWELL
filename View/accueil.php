<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Cinémathèque</title>
    <link rel="stylesheet" href="/P2025/WEBWORKWELL/style.css">
</head>
<body>
<?php include __DIR__ . '/header.php'; ?>
<main class="main-content">
    <div class="container">
        <h2>Découvrez les dernières œuvres</h2>
        <div class="oeuvres-container">
            <?php foreach ($oeuvresWithDetails as $details): ?>
                <div class="oeuvre-card">
                    <a href="/P2025/WEBWORKWELL/oeuvre/voir/<?= htmlspecialchars($details['oeuvre']->getCodeOeuvre()); ?>" class="oeuvre-link">
                        <img src="<?= htmlspecialchars($details['oeuvre']->getAffiche()); ?>" alt="<?= htmlspecialchars($details['oeuvre']->getTitreFrancaisOeuvre()); ?>" class="oeuvre-img">
                        <h3 class="oeuvre-title"><?= htmlspecialchars($details['oeuvre']->getTitreFrancaisOeuvre()); ?></h3>
                    </a>
                    <?php if ($details['realisateur']): ?>
                        <p class="oeuvre-director">
                            <img src="/P2025/WEBWORKWELL/Image/per.png" alt="Logo-Réalisateur" class="icon">
                            <?= htmlspecialchars($details['realisateur']->getPrenomRealisateur()) . ' ' . htmlspecialchars($details['realisateur']->getNomRealisateur()); ?>
                        </p>
                    <?php endif; ?>
                    <p class="oeuvre-genres">
                        <img src="/P2025/WEBWORKWELL/Image/lib.png" alt="Logo-Genre" class="icon">
                        <?php foreach ($details['genres'] as $genre): ?>
                            <?= htmlspecialchars($genre->getLibelleGenre()) . ', '; ?>
                        <?php endforeach; ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>
<?php include __DIR__ . '/footer.php'; ?>
</body>
</html>
