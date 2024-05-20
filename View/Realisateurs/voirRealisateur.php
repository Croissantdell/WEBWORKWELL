<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Voir Réalisateur</title>
    <link rel="stylesheet" href="/P2025/WEBWORKWELL/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
<?php include __DIR__ . '/../header.php'; ?>
<main class="main-content">
    <div class="container">
        <div class="realisateur-header">
            <h1><?php echo htmlspecialchars($realisateur->getNomRealisateur() . ' ' . $realisateur->getPrenomRealisateur()); ?></h1>
            <img src="<?php echo htmlspecialchars($realisateur->getPhoto()); ?>" alt="Photo de <?php echo htmlspecialchars($realisateur->getNomRealisateur()); ?>" class="realisateur-photo">
            <div class="realisateur-details">
                <p><strong>Nationalité :</strong> <?php echo htmlspecialchars($realisateur->getNationaliteRealisateur()); ?></p>
                <p><strong>Récompenses :</strong> <?php echo htmlspecialchars($realisateur->getRecompenseRealisateur()); ?></p>
            </div>
        </div>

        <h2>Œuvres</h2>
        <div class="oeuvres-container">
            <?php foreach ($oeuvres as $oeuvre): ?>
                <div class="oeuvre-card">
                    <a href="/P2025/WEBWORKWELL/oeuvre/voir/<?php echo $oeuvre->getCodeOeuvre(); ?>" class="oeuvre-link">
                        <img src="<?php echo htmlspecialchars($oeuvre->getAffiche()); ?>" alt="<?php echo htmlspecialchars($oeuvre->getTitreFrancaisOeuvre()); ?>" class="oeuvre-img">
                        <div class="oeuvre-title"><?php echo htmlspecialchars($oeuvre->getTitreFrancaisOeuvre()); ?></div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="actions">
            <?php if ($isLoggedIn): ?>
                <a href="/P2025/WEBWORKWELL/realisateur/modifier/<?php echo $realisateur->getIdRealisateur(); ?>" class="btn">Modifier</a>
                <a href="/P2025/WEBWORKWELL/realisateur/supprimer/<?php echo $realisateur->getIdRealisateur(); ?>" class="btn">Supprimer</a>
            <?php endif; ?>
            <a href="/P2025/WEBWORKWELL/realisateur/liste" class="btn">Retour à la liste</a>
        </div>
    </div>
</main>
<?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>
