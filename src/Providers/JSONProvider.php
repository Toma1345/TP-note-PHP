<?php

namespace App\Providers;

class JSONProvider {
    public static function load(string $filepath): array {
        if (!file_exists($filepath)) {
            throw new \Exception("Le fichier $filepath est introuvable.");
        }
        
        $data = json_decode(file_get_contents($filepath), true);
        if (empty($data)) {
            throw new \Exception(sprintf('Pas de données dans le fichier "%s"'));
        }
        else {
            return $data;
        }
    }

    public static function validate($data) {
        if (!isset($data['title'], $data['questions'])) {
            throw new Exception("Fichier JSON invalide : titre ou questions manquants.");
        }
    
        foreach ($data['questions'] as $q) {
            if (!isset($q['text'], $q['choices'], $q['answer'])) {
                throw new Exception("Fichier JSON invalide : une ou plusieurs questions sont mal formatées.");
            }
        }
        return true;
    }
    
}
