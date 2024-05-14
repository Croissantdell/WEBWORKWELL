<?php
session_start();

if (!isset($_GET['type'])) {
    echo "Paramètres manquants.";
    exit;
}

$type = htmlspecialchars($_GET['type']);
$urlEdition = '';
$urlAjout = '';
$urlSuppression = '';

switch ($type) {
    case 'realisateur':
        $urlEdition = 'edit_realisateur.php';
        $urlAjout = 'add_realisateur.php';
        $urlSuppression = 'delete_realisateur.php';
        break;
    case 'acteur':
        $urlEdition = 'edit_acteur.php';
        $urlAjout = 'add_acteur.php';
        $urlSuppression = 'delete_acteur.php';
        break;
    case 'genre':
        $urlEdition = 'edit_genre.php';
        $urlAjout = 'add_genre.php';
        $urlSuppression = 'delete_genre.php';
        break;
    case 'classification':
        $urlEdition = 'edit_classification.php';
        $urlAjout = 'add_classification.php';
        $urlSuppression = 'delete_classification.php';
        break;
    default:
        echo "Type inconnu.";
        exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Choix de l'action</title>
    <link rel="stylesheet" href="../Style.css">
</head>
<body>
<?php include 'header.php'; ?>
<main>
    <h1>Choisissez l'action pour <?= ucfirst($type); ?></h1>
    <form action="" method="get">
        <input type="hidden" name="type" value="<?= $type; ?>">
        <button type="button" onclick="window.location.href='<?= $urlEdition; ?>'">Éditer</button>
        <button type="button" onclick="window.location.href='<?= $urlAjout; ?>'">Ajouter</button>
        <button type="button" onclick="window.location.href='<?= $urlSuppression; ?>'">Supprimer</button>
    </form>
</main>
</body>
</html>
<?php include 'footer.php'; ?>
