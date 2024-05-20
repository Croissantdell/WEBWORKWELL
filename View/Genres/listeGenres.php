<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Genres - Cinémathèque</title>
    <link rel="stylesheet" href="/P2025/WEBWORKWELL/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
<?php include __DIR__ . '/../header.php'; ?>
<main class="main-content">
    <div class="container">
        <h1 class="page-title">Liste des Genres</h1>
        <div class="add-genre">
            <h2>Ajouter un Genre</h2>
            <form action="/P2025/WEBWORKWELL/genre/ajouter" method="post" class="genre-form">
                <label for="libelle">Libellé :</label>
                <input type="text" id="libelle" name="libelle" required>
                <button type="submit" class="btn btn-primary">Ajouter</button>
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
            <?php foreach ($genres as $genre): ?>
                <tr>
                    <td><?php echo $genre->getIdGenre(); ?></td>
                    <td><?php echo $genre->getLibelleGenre(); ?></td>
                    <td>
                        <a href="/P2025/WEBWORKWELL/genre/voir/<?php echo $genre->getIdGenre(); ?>" class="btn btn-view">Voir</a>
                        <a href="/P2025/WEBWORKWELL/genre/modifier/<?php echo $genre->getIdGenre(); ?>" class="btn btn-edit">Modifier</a>
                        <a href="/P2025/WEBWORKWELL/genre/supprimer/<?php echo $genre->getIdGenre(); ?>" class="btn btn-delete">Supprimer</a>
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
