<?php
	require_once "includes/fonctions.php";
	session_start();
	unset($_SESSION['erreur']); //On nettoie la variable de session "erreur"

if (!empty($_POST['question'])) {
	$bdd = getDb();
	//On recupère le numéro de la question à insérer par rapport aux autres questions présentes dans la BD
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
	$_SESSION['ajoutReponses'] = "pas bon";
	$_SESSION['erreur'] = "Veuillez proposer une question...";
    header('Location: ajoutQuestion.php');
}
?>



<?php require_once "includes/head.php"; ?>
	<body id="ecran-admin">
		<?php require_once "includes/header.php"; ?>
		<?php if (isset($_SESSION['erreur'])) { ?>
            <div class="alert alert-danger">
                <strong>Erreur !</strong> <?= $_SESSION['erreur'] ?>
            </div>
        <?php }
        unset($_SESSION['erreur']); //On nettoie la variable de session "erreur" après l'avoir utilisée (c'est peut être sale attention)
        ?>
		
		<div id="ajout-question-container">
		    <h1><?php echo $_SESSION['titreQuizModifie']; ?></h1>
		    <h3><?php echo $libelle; ?></h3>
		    <!-- ========== SI LA QUESTION EST UNE QRU ========== -->
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


			<!-- ========== SI LA QUESTION EST UNE QRM ==========  -->
		    <?php } elseif ($typeQuestion == "QRM") { ?>
		    <form id="nouveau-quiz-form" role="form" action="ajoutQRM.php" method="post">
				<fieldset class="form-group">
				  	<div class="form-group">
				    	<label for="reponse-1" id="reponse-1"><h4>Réponse 1: </h4></label>
				    	<input type="text" class="form-control" id="reponse-1" placeholder="Ex : 1914" name="reponse-1">
				  	</div>
				  	<div class="form-check form-check-inline">
					  	<input class="form-check-input" type="radio" name="radio-reponse-1" id="vrai" value="vrai" checked>
					  	<label class="form-check-label" for="QRU">Bonne réponse</label>
					</div>
					<div class="form-check form-check-inline">
					  	<input class="form-check-input" type="radio" name="radio-reponse-1" id="faux" value="faux">
					  	<label class="form-check-label" for="QRM">Mauvaise réponse</label>
					</div>
				</fieldset>
			  	<fieldset class="form-group">
				  	<div class="form-group">
				    	<label for="reponse-2" id="reponse-2"><h4>Réponse 2: </h4></label>
				    	<input type="text" class="form-control" id="reponse-2" placeholder="Ex : 1901" name="reponse-2">
				  	</div>
				  	<div class="form-check form-check-inline">
					  	<input class="form-check-input" type="radio" name="radio-reponse-2" id="vrai" value="vrai" checked>
					  	<label class="form-check-label" for="vrai">Bonne réponse</label>
					</div>
					<div class="form-check form-check-inline">
					  	<input class="form-check-input" type="radio" name="radio-reponse-2" id="faux" value="faux">
					  	<label class="form-check-label" for="faux">Mauvaise réponse</label>
					</div>
				</fieldset>
				<fieldset class="form-group">
				  	<div class="form-group">
				    	<label for="reponse-3" id="reponse-3"><h4>Réponse 3: </h4></label>
				    	<input type="text" class="form-control" id="reponse-3" placeholder="Ex : 1830" name="reponse-3">
				  	</div>
				  	<div class="form-check form-check-inline">
					  	<input class="form-check-input" type="radio" name="radio-reponse-3" id="vrai" value="vrai" checked>
					  	<label class="form-check-label" for="vrai">Bonne réponse</label>
					</div>
					<div class="form-check form-check-inline">
					  	<input class="form-check-input" type="radio" name="radio-reponse-3" id="faux" value="faux">
					  	<label class="form-check-label" for="faux">Mauvaise réponse</label>
					</div>
				</fieldset>
				<fieldset class="form-group">
				  	<div class="form-group">
				    	<label for="reponse-4" id="reponse-4"><h4>Réponse 4: </h4></label>
				    	<input type="text" class="form-control" id="reponse-4" placeholder="Ex : 1789" name="reponse-4">
				  	</div>
				  	<div class="form-check form-check-inline">
					  	<input class="form-check-input" type="radio" name="radio-reponse-4" id="vrai" value="vrai" checked>
					  	<label class="form-check-label" for="vrai">Bonne réponse</label>
					</div>
					<div class="form-check form-check-inline">
					  	<input class="form-check-input" type="radio" name="radio-reponse-4" id="faux" value="faux">
					  	<label class="form-check-label" for="faux">Mauvaise réponse</label>
					</div>
				</fieldset>
			  	<button type="submit" class="btn" id="nouveau-quiz-bouton-valider">Valider</button>
			</form>
		    
		    <!-- ========== SI LA QUESTION EST UNE QOuverte ========== -->
		    <?php } else { ?>
		    <form id="nouveau-quiz-form" role="form" action="ajoutQOuverte.php" method="post">
				<fieldset class="form-group">
				  	<div class="form-group">
				    	<label for="reponse" id="reponse"><h4>Bonne réponse : </h4></label>
				    	<input type="text" class="form-control" id="reponse" placeholder="Ex : 1914" name="reponse">
				  	</div>
				</fieldset>
			  	<button type="submit" class="btn" id="nouveau-quiz-bouton-valider">Valider</button>
			</form>
			<?php } ?>
		</div>
	</body>


