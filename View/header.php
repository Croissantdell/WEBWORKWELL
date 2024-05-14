<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projet PHP</title>
    <link rel="stylesheet" href="Style.css">
</head>
<body>
<header class="main-header">
    <nav class="main-nav">
        <ul class="nav-list">
            <li class="nav-item"><a href="accueil.php" class="nav-link">Accueil</a></li>
            <li class="nav-item"><a href="listeOeuvres.php" class="nav-link">Liste Oeuvres</a></li>
            <li class="nav-item"><a href="listeacteurs.php" class="nav-link">Liste Acteurs</a></li>
            <li class="nav-item"><a href="listeRealisateurs.php" class="nav-link">Liste Realisateurs</a></li>
            

        </ul>

        <div class="user-account">
            <?php if(isset($_SESSION['idCompte'])): ?>
                <a href="compte.php" class="btn btn-primary logout-btn">Ajouter oeuvre</a>
                <a href="add_realisateur.php" class="btn btn-primary logout-btn">Ajouter realisateur</a>
                <a href="add_acteur.php" class="btn btn-primary logout-btn">Ajouter acteur</a>
                <a href="add_genre.php" class="btn btn-primary logout-btn">Ajouter genre</a>
                <a href="add_classification.php" class="btn btn-primary logout-btn">Ajouter classification</a>


                <a href="logout.php" class="btn btn-primary logout-btn">Déconnexion</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-primary login-btn">Connexion</a>
            <?php endif; ?>
        </div>
    </nav>
</header>
</body>
</html>