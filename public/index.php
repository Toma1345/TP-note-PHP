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
    <title>Page d'accueil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f5f8;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 400px;
            text-align: center;
        }
        h1 {
            color: #333;
            font-size: 1.8em;
        }
        label {
            display: block;
            margin: 10px 0;
            color: #555;
        }
        input[type="file"] {
            margin: 15px 0;
            padding: 10px;
            width: 90%;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px 15px;
            font-size: 1em;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenue</h1>
        <form action="manager.php?action=upload" method="POST" enctype="multipart/form-data">
            <label for="username">Entrez votre nom d'utilisateur :</label>
            <input type="text" name="username" id="username" required>
            <label for="fileInput">Téléchargez un fichier JSON :</label>
            <input type="file" name="quizFile" id="fileInput" accept=".json" required>
            <button type="submit">Commencer</button>
        </form>
    </div>
</body>
</html>
