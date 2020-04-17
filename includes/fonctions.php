<?php
    function getDb() {
	    $servername = "localhost";
        $username = "id12709408_caracatsanispierre";
        $password = "Azerty12345!";
        $database = "id12709408_quizprojet";
        
        try {
            $bdd = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {    
            echo "Connection failed: " . $e->getMessage();
        }
        return ($bdd);
    }
?>