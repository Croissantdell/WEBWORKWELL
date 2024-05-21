<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Réalisateur</title>
    <link rel="stylesheet" href="/P2025/WEBWORKWELL/Style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
<?php include __DIR__ . '/../header.php'; ?>
<main class="edit-oeuvre">
    <h1>Modifier un Rélisateur</h1>
    <hr>
    <div class="container">
        <form action="/P2025/WEBWORKWELL/realisateur/modifier/<?php echo $realisateur->getIdRealisateur(); ?>" method="post" enctype="multipart/form-data" class="edit-form">
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($realisateur->getNomRealisateur()); ?>" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($realisateur->getPrenomRealisateur()); ?>" required>
            </div>
            <div class="form-group">
                <label for="nationalite">Nationalité :</label>
                <input type="text" id="nationalite" name="nationalite" value="<?php echo htmlspecialchars($realisateur->getNationaliteRealisateur()); ?>" required>
            </div>
            <div class="form-group">
                <label for="recompense">Récompenses :</label>
                <input type="number" id="recompense" name="recompense" value="<?php echo htmlspecialchars($realisateur->getRecompenseRealisateur()); ?>" required>
            </div>
            <label for="photo">Photo</label>
            <div class="input-wrapper">
                <input type="file" id="photo" name="photo">
            </div>
        </form>
        <div class="button-container">
            <input type="submit" value="Modifier">
        </div>

    </div>
</main>
<?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>
