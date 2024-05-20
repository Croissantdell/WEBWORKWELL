<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer le Genre</title>
    <link rel="stylesheet" href="/Style.css">
</head>
<body>
<h1>Supprimer le Genre</h1>
<?php if ($genre): ?>
    <p>Voulez-vous vraiment supprimer ce genre ?</p>
    <p><strong>ID:</strong> <?= htmlspecialchars($genre['idGenre']); ?></p>
    <p><strong>Libellé:</strong> <?= htmlspecialchars($genre['libelleGenre']); ?></p>
    <form method="post" action="index.php/genre/delete/<?= $genre['idGenre']; ?>">
        <input type="submit" value="Supprimer">
    </form>
<?php else: ?>
    <p>Genre non trouvé.</p>
<?php endif; ?>
<a href="index.php/genre/index">Retour à la liste des genres</a>
</body>
</html>
