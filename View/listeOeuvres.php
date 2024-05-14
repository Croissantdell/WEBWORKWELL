<?php
require_once '../database.php';
require_once '../Model/OeuvreDAO.php';

$database = new Database();
$db = $database->getPDO();

$search = isset($_GET['search']) ? $_GET['search'] : null;
$sort = isset($_GET['sort']) ? $_GET['sort'] : null;
$filter = isset($_GET['filter']) ? $_GET['filter'] : null;

$oeuvreDAO = new OeuvreDAO($db);
$oeuvres = $oeuvreDAO->getAllOeuvresdiff($search, $sort, $filter);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listing des Oeuvres</title>
    <link rel="stylesheet" href="../Style.css">
</head>
<body>
<?php include 'header.php'; ?>
<nav>
    <form action="" method="GET">
        <input type="text" name="search" placeholder="Recherche..."/>
        <button type="submit" name="sort" value="date">Date de Sortie</button>
        <button type="submit" name="filter" value="anime">Animé</button>
        <button type="submit" name="filter" value="film">Film</button>
        <button type="submit" name="filter" value="serie">Série</button>
        <button type="submit" name="all" value="all">Toutes les œuvres</button>
    </form>
</nav>
<main class="oeuvres-main">
    <h2 class="oeuvres-heading">Liste des Oeuvres</h2>
    <div class="oeuvres-container">
        <?php foreach ($oeuvres as $oeuvre): ?>
            <div class="oeuvre-card">
                <a href="oeuvre_detail.php?id=<?= htmlspecialchars($oeuvre['codeOeuvre']); ?>" class="oeuvre-link">
                    <img src="<?= htmlspecialchars($oeuvre['affiche']); ?>"
                         alt="<?= htmlspecialchars($oeuvre['titreFrancaisOeuvre']); ?>"
                         class="oeuvre-img">
                    <h3 class="oeuvre-title"><?= htmlspecialchars($oeuvre['titreFrancaisOeuvre']); ?></h3>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</main>
<?php include 'footer.php'; ?>
</body>
</html>