<?php
require_once '../database.php';
require_once '../Model/RealisateurDAO.php';
require_once '../Model/OeuvreDAO.php';

$realisateurId = $_GET['id'] ?? '';

$database = new Database();
$db = $database->getPDO();

$realisateurDAO = new RealisateurDAO($db);
$realisateur = $realisateurDAO->getRealisateurById($realisateurId);
$oeuvres = $realisateurDAO->getOeuvresByRealisateur($realisateurId);

if (!$realisateur) {
    die('Réalisateur non trouvé');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails Réalisateur</title>
    <link rel="stylesheet" href="../Style.css">
</head>
<body>
<?php include 'header.php'; ?>
<main>
    <h1>Oeuvres réalisées par <?= htmlspecialchars($realisateur['prenomRealisateur'] . ' ' . $realisateur['nomRealisateur']); ?></h1>
    <div class="oeuvres-container">
        <?php foreach ($oeuvres as $oeuvre): ?>
            <div class="oeuvre">
                <a href="oeuvre_detail.php?id=<?= htmlspecialchars($oeuvre['codeOeuvre']); ?>">
                    <img src="<?= htmlspecialchars($oeuvre['affiche']); ?>"
                         alt="<?= htmlspecialchars($oeuvre['titreFrancaisOeuvre']); ?>">
                    <h3><?= htmlspecialchars($oeuvre['titreFrancaisOeuvre']); ?></h3>
                </a>
                <p><?= htmlspecialchars($oeuvre['resumeOeuvre']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</main>
</body>
</html>
<?php include 'footer.php'; ?>
