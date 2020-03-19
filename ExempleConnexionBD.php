<!DOCTYPE html>

<?php session_start();?>

<html lang="fr">
	
	<?php require_once "includes/head.php"; ?>
	<?php require_once "includes/header.php"; ?>
	<?php require_once "includes/fonctions.php"; ?>

	<body>
	    <p>Test</p>

	    <?php
	    try {
		    //$bdd = new PDO("mysql:host=localhost;dbname=id12709408_quizprojet", "root", "root");
	        $bdd = getDb();
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

	    <?php 
	    $ajout = getDb()->prepare('insert into UTILISATEUR (Login, Mdp, Droits) values (?, ?, 0)');
		$ajout->execute(array($email, $mdp));
	    ?>

	</body>
</html>