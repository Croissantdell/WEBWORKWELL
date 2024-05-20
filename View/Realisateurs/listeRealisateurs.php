<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Réalisateurs</title>
    <link rel="stylesheet" href="/P2025/WEBWORKWELL/style.css">
</head>
<body>
<?php include __DIR__ . '/../header.php'; ?>
<main class="main-content">
    <div class="container">
        <h1>Liste des Réalisateurs</h1>
        <div class="actors-grid">
            <?php foreach ($realisateurs as $realisateur): ?>
                <div class="actor-card">
                    <a href="/P2025/WEBWORKWELL/realisateur/voir/<?php echo $realisateur->getIdRealisateur(); ?>">
                        <img src="<?php echo $realisateur->getPhoto(); ?>" alt="<?php echo $realisateur->getNomRealisateur(); ?>" class="actor-photo">
                        <p class="actor-name"><?php echo $realisateur->getNomRealisateur() . ' ' . $realisateur->getPrenomRealisateur(); ?></p>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>
<?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>
