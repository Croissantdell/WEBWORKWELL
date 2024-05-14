<?php
require_once '../database.php';
require_once '../Model/ActeurDAO.php';
require_once '../Model/OeuvreDAO.php';

$actorId = $_GET['id'] ?? '';

$database = new Database();
$db = $database->getPDO();

$actorDAO = new ActeurDAO($db);
$actor = $actorDAO->getActorById($actorId);
$oeuvres = $actorDAO->getOeuvresByActor($actorId);

if (!$actor) {
    die('Acteur non trouvé');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails Acteur</title>
    <link rel="stylesheet" href="../Style.css">
</head>
<body>
<?php include 'header.php'; ?>
<main>
    <h1>Oeuvres avec <?= ($actor['prenomActeur'] . ' ' . $actor['nomActeur']); ?></h1>
    <div class="oeuvres-container">
        <?php foreach ($oeuvres as $oeuvre): ?>
            <div class="oeuvre">
                <a href="oeuvre_detail.php?id=<?= ($oeuvre['codeOeuvre']); ?>">
                    <img src="<?= ($oeuvre['affiche']); ?>"
                         alt="<?= ($oeuvre['titreFrancaisOeuvre']); ?>">
                    <h3><?= ($oeuvre['titreFrancaisOeuvre']); ?></h3>
                </a>
                <p><?= ($oeuvre['resumeOeuvre']); ?></p>
                <?php if ($oeuvre['roleActeur'] == 1): ?>
                    <p>Role : Principal</p>
                <?php else: ?>
                    <p>Role : Secondaire</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</main>
</body>
</html>
<?php include 'footer.php'; ?>

