<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="/P2025/WEBWORKWELL/style.css">
</head>
<body>
<?php include __DIR__ . '/header.php'; ?>
<div class="main-container">
    <h2>Connexion</h2>
    <?php if (isset($error)): ?>
        <p class="error"><?= htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <form action="/P2025/WEBWORKWELL/authentification/login" method="post">
        <label for="login">Login :</label>
        <input type="text" id="login" name="login" required><br>
        <label for="motDePasse">Mot de Passe :</label>
        <input type="password" id="motDePasse" name="motDePasse" required><br>
        <button type="submit">Connexion</button>
    </form>
</div>
<?php include __DIR__ . '/footer.php'; ?>
</body>
</html>
