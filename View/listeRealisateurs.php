<?php
require_once '../database.php';
require_once '../Model/RealisateurDAO.php';

$database = new Database();
$dao = new RealisateurDAO($database->getPDO());
$realisateurs = $dao->getAllRealisateurs();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des réalisateurs</title>
    <link rel="stylesheet" href="../Style.css">
</head>
<body>
<?php include 'header.php'; ?>
<main class="realisateur-main">
    <h1 class="realisateur-heading">Liste des réalisateurs</h1>
    <div class="realisateurs-container">
        <?php foreach ($realisateurs as $realisateur): ?>
            <div class="realisateur-card">
                <a href="realisateur_detail.php?id=<?= htmlspecialchars($realisateur['idRealisateur']); ?>" class="realisateur-link">
                    <img src="<?= htmlspecialchars($realisateur['photo']); ?>"
                         alt="<?= htmlspecialchars($realisateur['prenomRealisateur'] . ' ' . $realisateur['nomRealisateur']); ?>" class="realisateur-image">
                    <h3 class="realisateur-name"><?= htmlspecialchars($realisateur['prenomRealisateur'] . ' ' . $realisateur['nomRealisateur']); ?></h3>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</main>
</body>
</html>
<?php include 'footer.php'; ?>
