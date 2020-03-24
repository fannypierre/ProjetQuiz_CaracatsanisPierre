<?php
	require_once "includes/fonctions.php";
	session_start();
	unset($_SESSION['erreur']); //On nettoie la variable de session "erreur"

if (!empty($_POST['question'])) {
	$bdd = getDb();
	//On recupère le numéro du questionnaire à insérer par rapport aux autres quesionnaires présents dans la BD
	$questions = $bdd->query("Select * from QUESTION");
	$numQuestion = -1;
	foreach ($questions as $question) {
		if ($question["NumQuestion"] > $numQuestion) {
			$numQuestion = $question["NumQuestion"];
		}
	}
	$numQuestion = $numQuestion + 1;
	$typeQuestion = $_POST['typeQuestion'];
	$libelle = $_POST['question'];

	//Insert la question dans la BD
    $req = $bdd->prepare('insert into QUESTION (NumQuestion, Type, LibelleQuestion) values (?, ?, ?)');
    $req->execute(array($numQuestion, $typeQuestion, $libelle));

 	// //On lie la question créée et le questionnaire
    $idQuiz = $_SESSION['idQuizModifie'];
    $jointure = $bdd->prepare('insert into ASSOCIATIONQQ (NumQuestionnaire, NumQuestion) values (?, ?)');
    $jointure->execute(array($idQuiz, $numQuestion));

    $_SESSION['idQuestionModifie'] = $numQuestion;

} else { //Si tous les champs n'ont pas été saisis
	echo "rien ne va plus";
	$_SESSION['erreur'] = "Veuillez proposer une question...";
    header('Location: ajoutQuestion.php');
}
?>
<?php require_once "includes/head.php"; ?>
	<body id="ecran-adnim">
		<?php require_once "includes/header.php"; ?>
	    <h1><?php echo $_SESSION['titreQuizModifie'] ?></h1>
	    <h3><?php echo $libelle ?></h3>

	    <!-- !!! SI LA QUESTION EST UNE QRU !!! -->
	    <?php if ($typeQuestion == "QRU") {
		?>
		<form id="nouveau-quiz-form" role="form" action="ajoutQRU.php" method="post">
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
		  	<button type="submit" class="btn" id="nouveau-quiz-bouton-valider">Valider</button>
		</form>

	    <?php } ?>

	    <!-- !!! SI LA QUESTION EST UNE QRM !!! ======= A FAIRE ======= -->
	    
	    <!-- !!! SI LA QUESTION EST UNE QOuverte ~ AFAIRE ~ !!! -->
	</body>


