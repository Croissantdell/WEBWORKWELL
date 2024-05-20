<?php
require_once __DIR__ . '/../Controller/VerificationController.php';
$isLoggedIn = isLoggedIn();
?>

<header class="main-header">
    <div class="container">
        <h1 class="site-title">WEB WORK WELL</h1>
        <nav class="main-nav">
            <ul class="nav-list">
                <li class="nav-item"><a href="/P2025/WEBWORKWELL/accueil" class="nav-link">Accueil</a></li>
                <li class="nav-item"><a href="/P2025/WEBWORKWELL/oeuvre" class="nav-link">Listes Oeuvres</a></li>
                <li class="nav-item"><a href="/P2025/WEBWORKWELL/acteur" class="nav-link">Liste Acteurs</a></li>
                <li class="nav-item"><a href="/P2025/WEBWORKWELL/realisateur" class="nav-link">Liste Réalisateurs</a></li>
            </ul>
        </nav>
        <div class="user-info">
            <?php if ($isLoggedIn): ?>
                <div class="dropdown">
                    <span class="username"><?= htmlspecialchars($_SESSION['username']); ?></span>
                    <div class="dropdown-content">
                        <a href="/P2025/WEBWORKWELL/oeuvre/ajouter">Ajouter oeuvre</a>
                        <a href="/P2025/WEBWORKWELL/acteur/ajouter">Ajouter Acteur</a>
                        <a href="/P2025/WEBWORKWELL/realisateur/ajouter">Ajouter Realisateur</a>
                        <a href="/P2025/WEBWORKWELL/genre/">Gestion Genre</a>
                        <a href="/P2025/WEBWORKWELL/classification/">Gestion Classification</a>

                        <a href="/P2025/WEBWORKWELL/authentification/logout">Déconnexion</a>
                    </div>
                </div>
            <?php else: ?>
                <a href="/P2025/WEBWORKWELL/authentification/login" class="user-link">Connexion</a>
                <a href="/P2025/WEBWORKWELL/authentification/inscription" class="user-link">Inscription</a>
            <?php endif; ?>
        </div>
    </div>
</header>
