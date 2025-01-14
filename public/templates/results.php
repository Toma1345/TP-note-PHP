<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
            text-align: center;
        }

        h1 {
            background-color: #4CAF50;
            color: white;
            margin: 0;
            padding: 1rem 0;
        }

        p {
            font-size: 1.2rem;
            margin: 2rem 0;
        }

        a {
            display: inline-block;
            margin: 1rem 0;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            color: white;
            background-color: #4CAF50;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Résultats</h1>
    <p>Votre score est : <?= $_SESSION['score'] ?? 0; ?> / <?= $_SESSION['nbquestions'] ?? 0; ?></p>
    <a href="index.php">Recommencer</a>
</body>
</html>
