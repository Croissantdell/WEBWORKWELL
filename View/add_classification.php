<?php
require_once '../Model/ClassificationBO.php';
require_once '../Model/ClassificationDAO.php';
require_once '../database.php';

$database = new Database();
$db = $database->getPDO();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codeClassification = $_POST['codeClassification'];
    $libelleClassification = $_POST['libelleClassification'];

    $classification = new ClassificationBO($codeClassification, $libelleClassification);
    $classificationDAO = new ClassificationDAO($db);

    if ($classificationDAO->createClassification($classification)) {
        echo "Classification ajoutée avec succès !";
    } else {
        echo "Erreur lors de l'ajout de la classification.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Classification</title>
    <link rel="stylesheet" href="../Style.css">
</head>
<body>
<?php include 'header.php'; ?>
<div class="form-container">
    <h2>Ajouter une Classification</h2>
    <form action="add_classification.php" method="POST" class="add-classification-form">
        <div class="form-group">
            <label for="codeClassification">Code Classification:</label>
            <input type="text" id="codeClassification" name="codeClassification" required>
        </div>
        <div class="form-group">
            <label for="libelleClassification">Libellé:</label>
            <input type="text" id="libelleClassification" name="libelleClassification" required>
        </div>
        <button type="submit" class="form-submit">Ajouter</button>
    </form>
</div>
</body>
</html>
<?php include 'footer.php'; ?>
