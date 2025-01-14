<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
    $_SESSION['username'] = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion au Quiz</title>
</head>
<body>
    <h1>Bienvenue sur le Quiz</h1>
    <form method="POST" action="manager.php?action=upload" enctype="multipart/form-data">
    <label for="username">Entrez votre nom d'utilisateur :</label>
    <input type="text" id="username" name="username" required>

    <label for="fileInput">Choisissez un fichier JSON :</label>
    <input type="file" id="fileInput" name="quizFile" accept=".json" required>
    
    <button type="submit">Commencer</button>
    </form>
</body>
</html>