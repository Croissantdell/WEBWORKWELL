<?php
session_start();

if (!isset($_SESSION['idCompte'])) {
    header("Location: login.php");
    exit;
}

require_once '../Model/ActeurDAO.php';
require_once '../database.php';

$database = new Database();
$db = $database->getPDO();

$acteurDAO = new ActeurDAO($db);
$acteurs = $acteurDAO->getAllActeurs();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_acteur'])) {
    $idActeur = $_POST['delete_acteur'];
    $acteurDAO->deleteActeur($idActeur);
    $_SESSION['message'] = "Acteur supprimé avec succès.";
    header("Location: liste_acteurs.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Acteurs</title>
    <link rel="stylesheet" href="../Style.css">
</head>
<body>
<?php include 'header.php'; ?>
<main>
    <h1>Liste des Acteurs</h1>
    <?php if (isset($_SESSION['message'])): ?>
        <p><?= $_SESSION['message']; unset($_SESSION['message']); ?></p>
    <?php endif; ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($acteurs as $acteur): ?>
            <tr>
                <td><?= htmlspecialchars($acteur['idActeur']); ?></td>
                <td><?= htmlspecialchars($acteur['nomActeur']); ?></td>
                <td><?= htmlspecialchars($acteur['prenomActeur']); ?></td>
                <td>
                    <a href="edit_acteur.php?id=<?= htmlspecialchars($acteur['idActeur']); ?>">Modifier</a>
                    <form method="post" action="" style="display:inline;">
                        <input type="hidden" name="delete_acteur" value="<?= htmlspecialchars($acteur['idActeur']); ?>">
                        <button type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="add_acteur.php">Ajouter un nouveau acteur</a>
</main>
</body>
</html>
<?php include 'footer.php'; ?>
