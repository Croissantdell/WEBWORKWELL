<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Voir Acteur</title>
    <link rel="stylesheet" href="/P2025/WEBWORKWELL/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
<?php include __DIR__ . '/../header.php'; ?>
<main class="main-content">
    <div class="container">
        <div class="acteur-header">
            <h1><?php echo htmlspecialchars($acteur->getNomActeur() . ' ' . $acteur->getPrenomActeur()); ?></h1>
            <img src="/P2025/WEBWORKWELL/Image/Acteur/<?php echo htmlspecialchars($acteur->getPhoto()); ?>" alt="Photo de <?php echo htmlspecialchars($acteur->getNomActeur()); ?>" class="acteur-photo">
            <div class="acteur-details">
                <p><strong>Nationalité :</strong> <?php echo htmlspecialchars($acteur->getNationaliteActeur()); ?></p>
                <p><strong>Date de Naissance :</strong> <?php echo htmlspecialchars($acteur->getDateNaissanceActeur()->format('Y-m-d')); ?></p>
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
                <a href="/P2025/WEBWORKWELL/acteur/modifier/<?php echo $acteur->getIdActeur(); ?>" class="btn">Modifier</a>
                <a href="/P2025/WEBWORKWELL/acteur/supprimer/<?php echo $acteur->getIdActeur(); ?>" class="btn">Supprimer</a>
            <?php endif; ?>
            <a href="/P2025/WEBWORKWELL/acteur/liste" class="btn">Retour à la liste</a>
        </div>
    </div>
</main>
<?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>
