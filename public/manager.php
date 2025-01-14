<?php

require_once __DIR__ . '/../src/Utils/Autoloader.php';

use App\Utils\Autoloader;
use App\Controllers\QuizController;

Autoloader::register();

$action = $_GET['action'] ?? 'quiz';

switch ($action) {
    case 'quiz':
        QuizController::showQuiz();
        break;

    case 'check':
        QuizController::checkAnswers();
        break;

    case 'results':
        QuizController::showResults();
        break;

    case 'upload':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();

            if (isset($_FILES['quizFile'], $_POST['username'])) {
                $file = $_FILES['quizFile'];

                if ($file['type'] === 'application/json' && $file['error'] === UPLOAD_ERR_OK) {
                    $uploadDir = __DIR__ . '/../data/';
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }

                    $filePath = $uploadDir . basename($file['name']);
                    move_uploaded_file($file['tmp_name'], $filePath);

                    $_SESSION['username'] = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
                    $_SESSION['quizFile'] = $filePath;

                    header('Location: manager.php?action=quiz');
                    exit;
                } else {
                    echo "Erreur : Veuillez télécharger un fichier JSON valide.";
                }
            } else {
                echo "Erreur : Données du formulaire invalides.";
            }
        } else {
            echo "Méthode non autorisée.";
        }
        break;

    default:
        echo "Action non reconnue.";
        break;
}
