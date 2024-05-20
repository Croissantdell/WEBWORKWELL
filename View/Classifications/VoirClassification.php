<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Voir Classification</title>
    <link rel="stylesheet" href="/P2025/WEBWORKWELL/style.css">
</head>
<body>
<?php include __DIR__ . '/../header.php'; ?>
<main class="main-content">
    <div class="container">
        <h1>Voir Classification</h1>
        <p>ID : <?php echo $classification->getCodeClassification(); ?></p>
        <p>Libellé : <?php echo $classification->getLibelleClassification(); ?></p>
        <a href="/P2025/WEBWORKWELL/classification/liste" class="btn">Retour à la liste</a>
    </div>
</main>
<?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>
