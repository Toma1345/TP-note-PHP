<?php

namespace App\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Providers\JSONProvider;
use App\Utils\ScoreManager;


class QuizController {
    public static function showQuiz() {
        session_start();
    
        if (!isset($_SESSION['quizFile'])) {
            echo "Erreur : Aucun fichier de quiz sélectionné.";
            exit;
        }
    
        $filePath = $_SESSION['quizFile'];
        $data = JSONProvider::load($filePath);
        JSONProvider::validate($data);
    
        $quiz = new Quiz($data['title'], []);
        foreach ($data['questions'] as $q) {
            $quiz->addQuestion(new Question($q['text'], $q['choices'], $q['answer']));
        }
    
        require __DIR__ . '/../../public/templates/quiz.php';
    }
    

    public static function checkAnswers() {
        session_start();

        $answers = $_POST['answers'] ?? [];

        $filePath = $_SESSION['quizFile'];
        $data = JSONProvider::load($filePath);
        $correctAnswers = array_map(fn($q) => $q['answer'], $data['questions']);

        $score = 0;
        $nbq = 0;
        foreach ($answers as $index => $answer) {
            $nbq++;
            if ($answer === $correctAnswers[$index]) {
                $score++;
            }
        }

        $_SESSION['score'] = $score;
        $_SESSION['nbquestions'] = $nbq;

        // Enregistrement dans la base de données
        ScoreManager::saveUserScore($_SESSION['username'], $score);

        header('Location: manager.php?action=results');
    }

    public static function showResults() {
        require __DIR__ . '/../../public/templates/results.php';
    }
}
