<?php
    function getDb() {
        // try {
        //     $bdd = new PDO("mysql:host=localhost;dbname=id12709408_quizprojet", "root", "root");
        // } catch (PDOException $e) {
        //     echo 'Connexion échouée : ' . $e->getMessage();
        // }
        // return $bdd;
        // array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return new PDO("mysql:host=localhost;dbname=id12709408_quizprojet", "root", "root",
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));


    }
?>