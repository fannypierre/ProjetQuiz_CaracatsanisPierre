<!DOCTYPE html>
<?php session_start();?>
<?php if(isset($_SESSION["login"])) $user = $_SESSION["login"]; else $user = "User";?>

<html lang="fr">
	<head>
	  <meta charset="UTF-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <meta http-equiv="X-UA-Compatible" content="ie=edge">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	  <link rel="stylesheet" href="css/accueil.css"/>
	</head>

	<body>
	    <p>Test</p>

	    <?php
	    try {
		    $bdd = new PDO("mysql:host=localhost;dbname=id12709408_quizprojet", "root", "root");
	        $questions = $bdd -> query("SELECT * FROM QUESTION");
		} catch (PDOException $e) {
		    echo 'Connexion échouée : ' . $e->getMessage();
		}   
	     ?>

	    <div class="contenant">
	    	<p>Affichage des questions :</p>
	        <?php
	            foreach($questions as $question)
	            {
	                echo $question["LibelleQuestion"] . "</br>";
	            }
	         ?>
	    </div>

	</body>
</html>