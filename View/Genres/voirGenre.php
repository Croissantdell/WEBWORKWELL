<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Voir Genre</title>
    <link rel="stylesheet" href="/P2025/WEBWORKWELL/style.css">
</head>
<body>
<?php include __DIR__ . '/../header.php'; ?>
<main>
    <h1>Voir le Genre</h1>
    <p>ID : <?php echo $genre->getIdGenre(); ?></p>
    <p>Libellé : <?php echo $genre->getLibelleGenre(); ?></p>
    <a href="/P2025/WEBWORKWELL/genre/liste">Retour à la liste</a>
</main>
<?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>
