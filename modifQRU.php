<?php
session_start();	
require_once "includes/fonctions.php";
require_once "connexionBD.php";
unset($_SESSION['erreur']); //On nettoie la variable de session "erreur"

$question_id = $_GET['question_id'];
$quiz_id = $_GET['quiz_id'];

if (!empty($_POST['question']) && !empty($_POST['bonne-reponse']) && !empty($_POST['mauvaise-reponse-1']) && !empty($_POST['mauvaise-reponse-2']) && !empty($_POST['mauvaise-reponse-3']) ) {
	$question = $_POST['question'];
	$bonneRep = $_POST['bonne-reponse'];
	$mauvaiseRep1 = $_POST['mauvaise-reponse-1'];
	$mauvaiseRep2 = $_POST['mauvaise-reponse-2'];
	$mauvaiseRep3 = $_POST['mauvaise-reponse-3'];

	//Update question
	$bdd = getDb();
	$requete1 = $bdd->prepare("UPDATE QUESTION SET LibelleQuestion = ? WHERE NumQuestion = ?");
    $requete1->execute(array($question, $question_id));

	//Update bonne reponse
	$answers = get_quizz_answers($question_id);
	
	//Update mauvaises reponses
	$indice = 0;
    foreach ($answers as $answer) {
    	$requete1 = $bdd->prepare("UPDATE REPONSE SET Libelle = ? WHERE NumReponse = ?");
    	if ($indice == 0) {
    		$requete1->execute(array($bonneRep, $answer["NumReponse"]));
    	} else {
    		//$requete1 = $bdd->prepare("UPDATE REPONSE SET Libelle = ? WHERE NumReponse = ?");
	    	$mauvaiseReponse = "mauvaise-reponse-" . $indice;
			$mauvaise = $_POST["$mauvaiseReponse"];
			$requete1->execute(array($mauvaise, $answer["NumReponse"]));
    	}
    	
		$indice = $indice + 1;
    }
    $_SESSION['majQuestion'] = "Question bien mise à jour !";
    $location = "modifQuiz.php?quiz_id=".$quiz_id;
	header("Location: $location");
} else {
	if (isset($_POST["premierPassage"])) {
		$_SESSION['erreur'] = "Veuillez remplir tous les champs pour modifier la question";
		unset($_POST["premierPassage"]);
		$location = "modifQuiz.php?quiz_id=".$quiz_id;
		header("Location: $location");
	}
}

?>
<?php 
	require_once "includes/head.php"; 
?>
	<body id="ecran-admin">
		<?php require_once "includes/header.php";
        $url = "modifQRU.php?quiz_id=" . $quiz_id . "&question_id=" . $question_id; 
        ?>

		<div id="nouveau-quiz-container">
		    <form id="modif-question-form" role="form" <?php echo "action='".$url."'"; ?> method="post">
				<fieldset class="form-group">
				  	<div class="form-group">
				    	<label for="titre" id="nouvelle-question"><h3>Nouvelle formulation de la question :</h3></label>
				    	<input type="text" class="form-control" id="question" placeholder="Ex : Quelle est la couleur du cheval blanc d'Henry IV ?" name="question">
				  	</div>
				</fieldset>
				<fieldset class="form-group">
				  	<div class="form-group">
				    	<label for="bonne-reponse" id="nouvelle-reponse"><h4>Bonne réponse : </h4></label>
				    	<input type="text" class="form-control" id="bonne-reponse" placeholder="Ex : Blanc" name="bonne-reponse">
				  	</div>
				</fieldset>
			  	<fieldset class="form-group">
			  		<div class="form-group">
				    	<label for="mauvaise-reponse-1" id="nouvelle-reponse"><h5>Mauvaise réponse 1 : </h5></label>
				    	<input type="text" class="form-control" id="mauvaise-reponse-1" placeholder="Ex : Rouge" name="mauvaise-reponse-1">
				  	</div>
				  	<div class="form-group">
				    	<label for="mauvaise-reponse-2" id="nouvelle-reponse"><h5>Mauvaise réponse 2 : </h5></label>
				    	<input type="text" class="form-control" id="mauvaise-reponse-2" placeholder="Ex : Vert" name="mauvaise-reponse-2">
				  	</div>
				  	<div class="form-group">
				    	<label for="mauvaise-reponse-3" id="nouvelle-reponse"><h5>Mauvaise réponse 3 : </h5></label>
				    	<input type="text" class="form-control" id="mauvaise-reponse-3" placeholder="Ex : Bleu" name="mauvaise-reponse-3">
				  	</div>
				</fieldset>
				<input type="hidden" value="premierPassage" name="premierPassage" />
			  	<button type="submit" class="btn" id="modif-quiz-bouton-valider">Valider</button>
			</form>
		</div>
	</body>


