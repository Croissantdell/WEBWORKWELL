<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Acteurs</title>
    <link rel="stylesheet" href="/P2025/WEBWORKWELL/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
<?php include __DIR__ . '/../header.php'; ?>
<main class="main-content">
    <div class="container">
        <h1>Liste des Acteurs</h1>
        <div class="actors-grid">
            <?php foreach ($acteurs as $acteur): ?>
                <div class="actor-card">
                    <a href="/P2025/WEBWORKWELL/acteur/voir/<?php echo $acteur->getIdActeur(); ?>" class="actor-link">
                        <img src="/P2025/WEBWORKWELL/Image/Acteur/<?php echo htmlspecialchars($acteur->getPhoto()); ?>" alt="<?php echo htmlspecialchars($acteur->getNomActeur() . ' ' . $acteur->getPrenomActeur()); ?>" class="actor-photo">
                        <h3 class="actor-name"><?php echo htmlspecialchars($acteur->getNomActeur() . ' ' . $acteur->getPrenomActeur()); ?></h3>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>
<?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>
