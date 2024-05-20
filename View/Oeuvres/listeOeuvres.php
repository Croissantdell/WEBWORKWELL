<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Oeuvres</title>
    <link rel="stylesheet" href="/P2025/WEBWORKWELL/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
<?php include __DIR__ . '/../header.php'; ?>
<main>
    <div class="container">
        <h2>Liste des Oeuvres</h2>
        <div class="search-container">
            <form action="/P2025/WEBWORKWELL/oeuvre" method="get">
                <input type="text" name="search" id="search" placeholder="Rechercher une oeuvre..." value="<?= htmlspecialchars($search) ?>">
                <button type="submit">Rechercher</button>
            </form>
        </div>
        <div class="filter-container">
            <form action="/P2025/WEBWORKWELL/oeuvre" method="get">
                <button class="filter-button" name="filter" value="">TOUT</button>
                <button class="filter-button" name="filter" value="film">FILMS</button>
                <button class="filter-button" name="filter" value="serie">SÉRIES</button>
                <button class="filter-button" name="filter" value="anime">MANGA</button>
                <button class="filter-button" name="filter" value="date">DATES SORTIES</button>
            </form>
        </div>
        <div class="oeuvres-container">
            <?php foreach ($oeuvresavecDetails as $details): ?>
                <div class="oeuvre-card">
                    <a href="/P2025/WEBWORKWELL/oeuvre/voir/<?= htmlspecialchars($details['oeuvre']->getCodeOeuvre()); ?>" class="oeuvre-link">
                        <img src="<?= htmlspecialchars($details['oeuvre']->getAffiche()); ?>" alt="<?= htmlspecialchars($details['oeuvre']->getTitreFrancaisOeuvre()); ?>" class="oeuvre-img">
                        <h3 class="oeuvre-title"><?= htmlspecialchars($details['oeuvre']->getTitreFrancaisOeuvre()); ?></h3>
                    </a>
                    <?php if (!is_null($details['realisateur'])): ?>
                        <p class="oeuvre-realisateur">
                            <img src="/P2025/WEBWORKWELL/Image/per.png" alt="Logo-Réalisateur" class="icon">
                            <?= htmlspecialchars($details['realisateur']->getPrenomRealisateur()) . ' ' . htmlspecialchars($details['realisateur']->getNomRealisateur()); ?>
                        </p>
                    <?php else: ?>
                        <p class="oeuvre-realisateur">
                            <img src="/P2025/WEBWORKWELL/Image/per.png" alt="Logo-Réalisateur" class="icon">
                            Réalisateur inconnu
                        </p>
                    <?php endif; ?>
                    <p class="oeuvre-genres">
                        <img src="/P2025/WEBWORKWELL/Image/lib.png" alt="Logo-Genre" class="icon">
                        <?php if (!empty($details['genres'])): ?>
                            <?php foreach ($details['genres'] as $genre): ?>
                                <?= htmlspecialchars($genre->getLibelleGenre()) . '  '; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            Genre inconnu
                        <?php endif; ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>
<?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>
