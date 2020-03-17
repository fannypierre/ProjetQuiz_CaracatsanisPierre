<!DOCTYPE html>

<?php session_start();?>
<?php if(isset($_SESSION["login"])) $user = $_SESSION["login"]; else $user = "User";?>

<html lang="fr">
	
	<?php require_once "includes/head.php"; ?>
	<?php require_once "includes/header.php"; ?>
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