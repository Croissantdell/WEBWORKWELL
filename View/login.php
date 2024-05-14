<?php
session_start();
require_once '../database.php';

$database = new Database();
$db = $database->getPDO();

if (isset($_SESSION['idCompte'])) {
    header('Location: compte.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['login'] ?? '';
    $password = $_POST['motDePasse'] ?? '';

    if (empty($username) || empty($password)) {
        $error = 'Veuillez remplir tous les champs.';
    } else {
        $sql = "SELECT idCompte, login, motDePasse FROM compte WHERE login = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && ($password === $user['motDePasse'])) {
            $_SESSION['idCompte'] = $user['idCompte'];
            $_SESSION['login'] = $user['login'];
            header('Location: accueil.php');
            exit;
        } else {
            $error = 'Identifiants incorrects.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="../Style.css">
</head>
<body>
<?php include 'header.php'; ?>
<div class="login-container">
    <h2 class="login-heading">Connexion</h2>
    <?php if ($error): ?>
        <p class="error-message"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form action="login.php" method="post" class="login-form">
        <div class="form-group">
            <label for="login" class="form-label">Nom d'utilisateur:</label>
            <input type="text" id="login" name="login" required class="form-input">
        </div>
        <div class="form-group">
            <label for="motDePasse" class="form-label">Mot de passe:</label>
            <input type="password" id="motDePasse" name="motDePasse" required class="form-input">
        </div>
        <button type="submit" class="form-submit">Connexion</button>
    </form>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
