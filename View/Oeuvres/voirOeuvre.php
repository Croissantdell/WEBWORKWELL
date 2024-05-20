<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($oeuvre->getTitreFrancaisOeuvre()); ?></title>
    <link rel="stylesheet" href="/P2025/WEBWORKWELL/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
<?php include __DIR__ . '/../header.php'; ?>
<main class="main-content">
    <div class="container">
        <h1><?php echo htmlspecialchars($oeuvre->getTitreFrancaisOeuvre()); ?></h1>
        <?php if (isLoggedIn()): ?>
            <div class="action-buttons">
                <a href="/P2025/WEBWORKWELL/oeuvre/supprimer/<?php echo $oeuvre->getCodeOeuvre(); ?>" class="btn btn-danger">Supprimer</a>
                <a href="/P2025/WEBWORKWELL/oeuvre/modifier/<?php echo $oeuvre->getCodeOeuvre(); ?>" class="btn btn-primary">Modifier</a>
            </div>
        <?php endif; ?>
        <div class="oeuvre-details">
            <div class="oeuvre-poster">
                <img src="<?php echo htmlspecialchars($oeuvre->getAffiche()); ?>" alt="Affiche de <?php echo htmlspecialchars($oeuvre->getTitreOriginalOeuvre()); ?>">
            </div>
            <div class="oeuvre-info">
                <p><strong>Titre original :</strong> <?php echo htmlspecialchars($oeuvre->getTitreOriginalOeuvre()); ?></p>
                <p><strong>Année de sortie :</strong> <?php echo htmlspecialchars($oeuvre->getAnneeSortieOeuvre()); ?></p>
                <p><strong>Résumé :</strong> <?php echo htmlspecialchars($oeuvre->getResumeOeuvre()); ?></p>
                <?php if (!empty($oeuvre->getNbEpisodeOeuvre())): ?>
                    <p><strong>Nombre d'épisodes :</strong> <?php echo htmlspecialchars($oeuvre->getNbEpisodeOeuvre()); ?></p>
                <?php endif; ?>
                <p><strong>Classification :</strong> <?php echo htmlspecialchars($classification->getLibelleClassification()); ?></p>
                <p><strong>Genre :</strong> <?php echo htmlspecialchars($genre->getLibelleGenre()); ?></p>
                <div class="cast">
                    <h2>Distribution</h2>
                    <div class="cast-lists">
                        <div class="actors">
                            <h3>Acteurs</h3>
                            <ul class="actors-list">
                                <?php foreach ($acteurs as $associe): ?>
                                    <li>
                                        <a href="/P2025/WEBWORKWELL/acteur/voir/<?php echo $associe['acteur']->getIdActeur(); ?>">
                                            <?php echo htmlspecialchars($associe['acteur']->getNomActeur() . ' ' . htmlspecialchars($associe['acteur']->getPrenomActeur())); ?>
                                        </a> - <?php echo $associe['roleActeur'] ? 'Principal' : 'Secondaire'; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="directors">
                            <h3>Réalisateurs</h3>
                            <ul class="directors-list">
                                <?php foreach ($realisateurs as $realisateur): ?>
                                    <li>
                                        <a href="/P2025/WEBWORKWELL/realisateur/voir/<?php echo $realisateur->getIdRealisateur(); ?>">
                                            <?php echo htmlspecialchars($realisateur->getNomRealisateur() . ' ' . htmlspecialchars($realisateur->getPrenomRealisateur())); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="/P2025/WEBWORKWELL/oeuvre/liste" class="btn btn-back">Retour à la liste</a>
    </div>
</main>
<?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>
