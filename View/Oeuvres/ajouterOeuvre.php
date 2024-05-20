<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter Oeuvre</title>
    <link rel="stylesheet" href="/P2025/WEBWORKWELL/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
<?php include __DIR__ . '/../header.php'; ?>
<main class="main-content">
    <div class="container">
        <h1>Ajouter une Oeuvre</h1>
        <form action="/P2025/WEBWORKWELL/oeuvre/ajouter" method="post" enctype="multipart/form-data" class="edit-form">
            <div class="form-group">
                <label for="titre_original">Titre Original</label>
                <input type="text" id="titre_original" name="titre_original" required>
            </div>
            <div class="form-group">
                <label for="titre_francais">Titre Français</label>
                <input type="text" id="titre_francais" name="titre_francais">
            </div>
            <div class="form-group">
                <label for="annee_sortie">Année de Sortie</label>
                <input type="number" id="annee_sortie" name="annee_sortie" required>
            </div>
            <div class="form-group">
                <label for="resume">Résumé</label>
                <textarea id="resume" name="resume" required></textarea>
            </div>
            <div class="form-group">
                <label for="nb_episodes">Nombre d'Épisodes</label>
                <input type="number" id="nb_episodes" name="nb_episodes">
            </div>
            <div class="form-group">
                <label for="affiche">Affiche</label>
                <input type="file" id="affiche" name="affiche">
            </div>
            <div class="form-group">
                <label for="code_classification">Classification</label>
                <select id="code_classification" name="code_classification" required>
                    <?php foreach ($classifications as $classification): ?>
                        <option value="<?= $classification->getCodeClassification(); ?>"><?= $classification->getLibelleClassification(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="id_genre">Genre</label>
                <select id="id_genre" name="id_genre" required>
                    <?php foreach ($genres as $genre): ?>
                        <option value="<?= $genre->getIdGenre(); ?>"><?= $genre->getLibelleGenre(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="acteur_principal">Acteur Principal</label>
                <select id="acteur_principal" name="acteur_principal" required>
                    <?php foreach ($acteurs as $acteur): ?>
                        <option value="<?= $acteur->getIdActeur(); ?>"><?= $acteur->getNomActeur() . ' ' . $acteur->getPrenomActeur(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="acteurs">Acteurs</label>
                <select id="acteurs" name="acteurs[]" multiple>
                    <?php foreach ($acteurs as $acteur): ?>
                        <option value="<?= $acteur->getIdActeur(); ?>"><?= $acteur->getNomActeur() . ' ' . $acteur->getPrenomActeur(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="realisateurs">Réalisateurs</label>
                <select id="realisateurs" name="realisateurs[]" multiple>
                    <?php foreach ($realisateurs as $realisateur): ?>
                        <option value="<?= $realisateur->getIdRealisateur(); ?>"><?= $realisateur->getNomRealisateur() . ' ' . $realisateur->getPrenomRealisateur(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn-submit">Ajouter</button>
            </div>
        </form>
    </div>
</main>
<?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>
