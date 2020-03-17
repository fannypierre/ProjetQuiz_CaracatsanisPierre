<?php
function getDb() {
    try {
        $bdd = new PDO("mysql:host=localhost;dbname=id12709408_quizprojet", "root", "root");
        $questions = $bdd -> query("SELECT * FROM QUESTION");
    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    }
    return $bdd;
}

function redirecte() {
    header("Location: $url");
}
?>