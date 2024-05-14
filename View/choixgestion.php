<?php
session_start();

if (!isset($_GET['type'])) {
    echo "Paramètres manquants.";
    exit;
}

$type = htmlspecialchars($_GET['type']);
$redirectListUrl = '';

switch ($type) {
    case 'realisateur':
        $redirectListUrl = 'liste_realisateurs.php';
        break;
    case 'acteur':
        $redirectListUrl = 'liste_acteurs.php';
        break;
    case 'genre':
        $redirectListUrl = 'listegenre.php';
        break;
    case 'classification':
        $redirectListUrl = 'liste_classifications.php';
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
        <button type="button" onclick="window.location.href='<?= $redirectListUrl; ?>'">Éditer ou Supprimer</button>
        <button type="button" onclick="window.location.href='add_<?= $type; ?>.php'">Ajouter</button>
    </form>
</main>
</body>
</html>
<?php include 'footer.php'; ?>
