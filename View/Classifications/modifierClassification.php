<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Classification</title>
    <link rel="stylesheet" href="/P2025/WEBWORKWELL/style.css">
</head>
<body>
<?php include __DIR__ . '/../header.php'; ?>
<main class="main-content">
    <div class="container">
        <h1>Modifier Classification</h1>
        <form action="/P2025/WEBWORKWELL/classification/modifier/<?php echo $classification->getCodeClassification(); ?>" method="post" class="form">
            <label for="libelle">Libellé :</label>
            <input type="text" id="libelle" name="libelle" value="<?php echo $classification->getLibelleClassification(); ?>" required>
            <button type="submit" class="btn">Modifier</button>
        </form>
    </div>
</main>
<?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>
