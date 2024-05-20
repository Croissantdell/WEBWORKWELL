<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Classifications</title>
    <link rel="stylesheet" href="/P2025/WEBWORKWELL/style.css">
</head>
<body>
<?php include __DIR__ . '/../header.php'; ?>
<main class="main-content">
    <div class="container">
        <h1>Liste des Classifications</h1>
        <div class="add-genre">
            <h2>Ajouter une Classification</h2>
            <form action="/P2025/WEBWORKWELL/classification/ajouter" method="post" class="genre-form">
                <label for="libelle">Libellé :</label>
                <input type="text" id="libelle" name="libelle" required>
                <button type="submit" class="btn">Ajouter</button>
            </form>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Libellé</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($classifications as $classification): ?>
                <tr>
                    <td><?php echo $classification->getCodeClassification(); ?></td>
                    <td><?php echo $classification->getLibelleClassification(); ?></td>
                    <td>
                        <a href="/P2025/WEBWORKWELL/classification/voir/<?php echo $classification->getCodeClassification(); ?>" class="btn">Voir</a>
                        <a href="/P2025/WEBWORKWELL/classification/modifier/<?php echo $classification->getCodeClassification(); ?>" class="btn">Modifier</a>
                        <a href="/P2025/WEBWORKWELL/classification/supprimer/<?php echo $classification->getCodeClassification(); ?>" class="btn">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
<?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>
