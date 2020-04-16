<?php
    function getDb() {
        // try {
        //     new PDO("mysql:host=localhost;dbname=id12709408_quizprojet", "id12709408_caracatsanispierre", "CaracatsanisPierre", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        // } catch (PDOException $e) {
        //     echo 'Connexion échouée : ' . $e->getMessage();
        // }
        // return $bdd;
        // array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        $servername = "localhost";
        $username = "root";
        $password = "root";
        $database = "id12709408_quizprojet";
        
        try {
            $bdd = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            // set the PDO error mode to exception
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connection ok";
        } catch(PDOException $e) {    
            echo "Connection failed: " . $e->getMessage();
        }
        return ($bdd);
        
    }
?>