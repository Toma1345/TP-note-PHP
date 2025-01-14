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
    <title>Quiz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        h1 {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 1rem 0;
            margin: 0;
        }

        p {
            text-align: center;
            margin: 1rem 0;
            font-size: 1.2rem;
        }

        form {
            max-width: 600px;
            margin: 2rem auto;
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        fieldset {
            border: 1px solid #ddd;
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 4px;
        }

        legend {
            font-size: 1.1rem;
            font-weight: bold;
            padding: 0 0.5rem;
        }

        label {
            display: block;
            margin: 0.5rem 0;
        }

        input[type="radio"] {
            margin-right: 0.5rem;
        }

        button {
            display: block;
            width: 100%;
            padding: 0.75rem;
            font-size: 1rem;
            color: white;
            background-color: #4CAF50;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1><?= $quiz->getTitle() ?></h1>
    <p>Bienvenue, <strong><?= htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8') ?></strong> !</p>
    <form method="POST" action="manager.php?action=check">
        <?php foreach ($quiz->getQuestions() as $index => $question): ?>
            <fieldset>
                <legend><?= $question->getText() ?></legend>
                <?php foreach ($question->getChoices() as $choice): ?>
                    <label>
                        <input type="radio" name="answers[<?= $index ?>]" value="<?= $choice ?>"> <?= $choice ?>
                    </label>
                <?php endforeach; ?>
            </fieldset>
        <?php endforeach; ?>
        <button type="submit">Valider</button>
    </form>
</body>
</html>
