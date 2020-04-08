<?php
session_start();	
require_once "includes/fonctions.php";
require_once "connexionBD.php";

$question_id = $_GET['question_id'];
$quiz_id = $_GET['quiz_id'];

if (!empty($_POST['question']) && !empty($_POST['reponse'])) {
	$question = $_POST['question'];
	$bonneRep = $_POST['reponse'];

	//Update question
	$bdd = getDb();
	$requete1 = $bdd->prepare("UPDATE QUESTION SET LibelleQuestion = ? WHERE NumQuestion = ?");
    $requete1->execute(array($question, $question_id));

	//Update bonne et mauvaises reponses
	$answers = get_quizz_answers($question_id);
	
    foreach ($answers as $answer) {  //Ici, une seule réponse dans la boucle
    	$requete1 = $bdd->prepare("UPDATE REPONSE SET Libelle = ? WHERE NumReponse = ?");
    	$requete1->execute(array($bonneRep, $answer["NumReponse"]));
    }
    $_SESSION['majQuestion'] = "Question bien mise à jour !";
    $location = "modifQuiz.php?quiz_id=".$quiz_id;
	header("Location: $location");
} else {
	if (isset($_POST["premierPassage"])) {
		$_SESSION['erreur'] = "Veuillez saisir la bonne réponse pour modifier la question";
		unset($_POST["premierPassage"]);
	}
}

?>
<?php 
	require_once "includes/head.php"; 
?>
	<body id="ecran-admin">
		<?php require_once "includes/header.php";
        $url = "modifQOuverte.php?quiz_id=" . $quiz_id . "&question_id=" . $question_id; 
        ?>

		<?php if (isset($_SESSION['erreur'])) { ?>
            <div class="alert alert-danger">
                <strong>Erreur !</strong> <?= $_SESSION['erreur'] ?>
            </div>
        <?php }
        unset($_SESSION['erreur']); //On nettoie la variable de session "erreur" après l'avoir utilisée (c'est peut être sale attention)
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
				    	<label for="reponse" id="reponse"><h4>Bonne réponse : </h4></label>
				    	<input type="text" class="form-control" id="reponse" placeholder="Ex : 1914" name="reponse">
				  	</div>
				</fieldset>
				<input type="hidden" value="premierPassage" name="premierPassage" />
			  	<button type="submit" class="btn" id="modif-quiz-bouton-valider">Valider</button>
			</form>
		</div>
	</body>


