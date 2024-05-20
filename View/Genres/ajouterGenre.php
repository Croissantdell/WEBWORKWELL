<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter Genre</title>
    <link rel="stylesheet" href="/P2025/WEBWORKWELL/style.css">
</head>
<body>
<?php include __DIR__ . '/../header.php'; ?>
<main>
    <h1>Ajouter un Genre</h1>
    <form action="/P2025/WEBWORKWELL/genre/ajouter" method="post">
        <label for="libelle">Libellé :</label>
        <input type="text" id="libelle" name="libelle" required><br>
        <button type="submit">Ajouter</button>
    </form>
</main>
<?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>
