<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer Oeuvre</title>
    <link rel="stylesheet" href="/P2025/WEBWORKWELL/style.css">
</head>
<body>
<?php include __DIR__ . '/../header.php'; ?>
<main class="main-content">
    <div class="container">
        <h1>Supprimer l'Oeuvre</h1>
        <p>Êtes-vous sûr de vouloir supprimer l'œuvre suivante ?</p>
        <div class="oeuvre-details">
            <img src="<?php echo htmlspecialchars($oeuvre->getAffiche()); ?>" alt="Affiche de <?php echo htmlspecialchars($oeuvre->getTitreOriginalOeuvre()); ?>" class="oeuvre-img">
            <p><strong>Titre Original :</strong> <?php echo htmlspecialchars($oeuvre->getTitreOriginalOeuvre()); ?></p>
        </div>
        <div class="actions">
            <form action="/P2025/WEBWORKWELL/oeuvre/supprimer/<?php echo $oeuvre->getCodeOeuvre(); ?>" method="post" class="delete-form">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
            <a href="/P2025/WEBWORKWELL/oeuvre/liste" class="btn btn-cancel">Annuler</a>
        </div>
    </div>
</main>
<?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>
