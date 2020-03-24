<?php
	require_once "includes/fonctions.php";
	session_start();
	unset($_SESSION['erreur']); //On nettoie la variable de session "erreur"

	if (!empty($_POST['titre'])) {
		$titre = $_POST['titre'];
		$affichage = $_POST['affichage'];

		$requete = getDb()->prepare('select * from QUESTIONNAIRE where Theme=?');
	    $requete->execute(array($titre));

	    if ($requete->rowCount() == 1) { //Si le quiz existe déjà : erreur
	        $_SESSION['erreur'] = "Quiz déjà existant !";
	        header('Location: nouveauQuiz.php');
	    }
	    else { 
	    	$bdd = getDb();
			//On recupère le numéro du questionnaire à insérer par rapport aux autres quesionnaires présents dans la BD
			$questionnaires = $bdd->query("Select * from QUESTIONNAIRE");
			$numQuestionnaire = -1;
			foreach ($questionnaires as $questionnaire) {
				if ($questionnaire["NumQuestionnaire"] > $numQuestionnaire) {
					$numQuestionnaire = $questionnaire["NumQuestionnaire"];
				}
			}
			$numQuestionnaire = $numQuestionnaire + 1;

		    $req = getDb()->prepare('insert into QUESTIONNAIRE (NumQuestionnaire, Theme, TypeAffichage) values (?, ?, ?)');
		    $req->execute(array($numQuestionnaire, $titre, $affichage));
	    }
	} else { //Si tous les champs n'ont pas été saisis
		echo "non";
		$_SESSION['erreur'] = "Veuillez indiquer le titre du questionnaire que vous voulez créer";
	    header('Location: nouveauQuiz.php');
	}
?>
<?php require_once "includes/head.php"; ?>
	
	<?php require_once "includes/header.php"; ?>
    <h1><?php echo $titre ?></h1>
