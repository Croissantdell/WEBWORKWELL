<?php
require_once '../database.php';
require_once '../Model/ActeurDAO.php';

$database = new Database();
$dao = new ActeurDAO($database->getPDO());
$actors = $dao->getAllActeurs();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des acteurs</title>
    <link rel="stylesheet" href="../Style.css">
</head>
<body>
<?php include 'header.php'; ?>
<main class="actor-main">
    <h1 class="actor-heading">Liste des acteurs</h1>
    <div class="actors-container">
        <?php foreach ($actors as $actor): ?>
            <div class="actor-card">
                <a href="actor_detail.php?id=<?= htmlspecialchars($actor['idActeur']); ?>" class="actor-link">
                    <img src="<?= htmlspecialchars($actor['photo']); ?>"
                         alt="<?= htmlspecialchars($actor['prenomActeur'] . ' ' . $actor['nomActeur']); ?>" class="actor-image">
                    <h3 class="actor-name"><?= htmlspecialchars($actor['prenomActeur'] . ' ' . $actor['nomActeur']); ?></h3>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</main>
</body>
</html>
<?php include 'footer.php'; ?>
