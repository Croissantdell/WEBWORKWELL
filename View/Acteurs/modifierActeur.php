<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Acteur</title>
    <link rel="stylesheet" href="/P2025/WEBWORKWELL/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
<?php include __DIR__ . '/../header.php'; ?>
<main class="main-content">
    <div class="container">
        <h1>Modifier Acteur</h1>
        <form action="/P2025/WEBWORKWELL/acteur/modifier/<?php echo $acteur->getIdActeur(); ?>" method="post" enctype="multipart/form-data" class="edit-form">
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($acteur->getNomActeur()); ?>" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($acteur->getPrenomActeur()); ?>" required>
            </div>
            <div class="form-group">
                <label for="nationalite">Nationalité :</label>
                <input type="text" id="nationalite" name="nationalite" value="<?php echo htmlspecialchars($acteur->getNationaliteActeur()); ?>" required>
            </div>
            <div class="form-group">
                <label for="date_naissance">Date de Naissance :</label>
                <input type="date" id="date_naissance" name="date_naissance" value="<?php echo $acteur->getDateNaissanceActeur()->format('Y-m-d'); ?>" required>
            </div>
            <div class="form-group">
                <label for="photo">Photo :</label>
                <input type="file" id="photo" name="photo">
            </div>
            <div class="form-group">
                <button type="submit" class="btn-submit">Modifier</button>
            </div>
        </form>
    </div>
</main>
<?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>
