<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Genre</title>
    <link rel="stylesheet" href="/P2025/WEBWORKWELL/style.css">
</head>
<body>
<?php include __DIR__ . '/../header.php'; ?>
<main>
    <h1>Modifier le Genre</h1>
    <form action="/P2025/WEBWORKWELL/genre/modifier/<?php echo $genre->getIdGenre(); ?>" method="post">
        <label for="libelle">Libellé :</label>
        <input type="text" id="libelle" name="libelle" value="<?php echo $genre->getLibelleGenre(); ?>" required><br>
        <button type="submit">Modifier</button>
    </form>
</main>
<?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>
