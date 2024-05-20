<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Oeuvre</title>
    <link rel="stylesheet" href="/P2025/WEBWORKWELL/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
<?php include __DIR__ . '/../header.php'; ?>
<main class="main-content">
    <div class="container">
        <h1>Modifier des Oeuvres</h1>
        <form action="/P2025/WEBWORKWELL/oeuvre/modifier/<?php echo $oeuvre->getCodeOeuvre(); ?>" method="post" enctype="multipart/form-data" class="edit-form">
            <div class="form-group">
                <label for="id_genre">Genre</label>
                <select id="id_genre" name="id_genre">
                    <?php foreach ($genres as $genre): ?>
                        <option value="<?php echo $genre->getIdGenre(); ?>" <?php if ($oeuvre->getIdGenre() == $genre->getIdGenre()) echo 'selected'; ?>><?php echo $genre->getLibelleGenre(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="nb_episodes">Nombre d'Épisodes</label>
                <input type="number" id="nb_episodes" name="nb_episodes" value="<?php echo $oeuvre->getNbEpisodeOeuvre(); ?>">
            </div>
            <div class="form-group">
                <label for="titre_original">Titre de l'Oeuvre</label>
                <input type="text" id="titre_original" name="titre_original" value="<?php echo $oeuvre->getTitreOriginalOeuvre(); ?>" required>
            </div>
            <div class="form-group">
                <label for="acteur_principal">Premier rôle</label>
                <select id="acteur_principal" name="acteur_principal">
                    <?php foreach ($acteurs as $acteur): ?>
                        <option value="<?php echo $acteur->getIdActeur(); ?>" <?php foreach ($acteursAssocies as $associe) { if ($associe['acteur']->getIdActeur() == $acteur->getIdActeur() && $associe['roleActeur'] == 1) echo 'selected'; } ?>><?php echo $acteur->getNomActeur() . ' ' . $acteur->getPrenomActeur(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="titre_francais">Titre Français</label>
                <input type="text" id="titre_francais" name="titre_francais" value="<?php echo $oeuvre->getTitreFrancaisOeuvre(); ?>">
            </div>
            <div class="form-group">
                <label for="acteurs">Autres acteurs</label>
                <select id="acteurs" name="acteurs[]" multiple>
                    <?php foreach ($acteurs as $acteur): ?>
                        <option value="<?php echo $acteur->getIdActeur(); ?>" <?php foreach ($acteursAssocies as $associe) { if ($associe['acteur']->getIdActeur() == $acteur->getIdActeur() && $associe['roleActeur'] == 0) echo 'selected'; } ?>><?php echo $acteur->getNomActeur() . ' ' . $acteur->getPrenomActeur(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="annee_sortie">Année de sortie</label>
                <input type="number" id="annee_sortie" name="annee_sortie" value="<?php echo $oeuvre->getAnneeSortieOeuvre(); ?>">
            </div>
            <div class="form-group">
                <label for="realisateurs">Réalisateur</label>
                <select id="realisateurs" name="realisateurs[]" multiple>
                    <?php foreach ($realisateurs as $realisateur): ?>
                        <option value="<?php echo $realisateur->getIdRealisateur(); ?>" <?php foreach ($realisateursAssocies as $associe) { if ($associe->getIdRealisateur() == $realisateur->getIdRealisateur()) echo 'selected'; } ?>><?php echo $realisateur->getNomRealisateur() . ' ' . $realisateur->getPrenomRealisateur(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="resume">Résumé</label>
                <textarea id="resume" name="resume"><?php echo $oeuvre->getResumeOeuvre(); ?></textarea>
            </div>
            <div class="form-group">
                <label for="code_classification">Classification</label>
                <select id="code_classification" name="code_classification">
                    <?php foreach ($classifications as $classification): ?>
                        <option value="<?php echo $classification->getCodeClassification(); ?>" <?php if ($oeuvre->getCodeClassification() == $classification->getCodeClassification()) echo 'selected'; ?>><?php echo $classification->getLibelleClassification(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="affiche">Affiche</label>
                <input type="file" id="affiche" name="affiche">
            </div>

            <div class="form-group">
                <button type="submit" class="btn-submit">Modifier</button>
            </div>
        </form>
    </div>
</main>
<?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>
