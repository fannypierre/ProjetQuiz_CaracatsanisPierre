<!-- Code pour la modification des réponses d'une QRM -->
<?php
session_start();	
require_once "includes/fonctions.php";
require_once "connexionBD.php";
unset($_SESSION['erreur']); //On nettoie la variable de session "erreur"

$question_id = $_GET['question_id'];
$quiz_id = $_GET['quiz_id'];

if (!empty($_POST['question']) && !empty($_POST['reponse-1']) && !empty($_POST['reponse-2']) && !empty($_POST['reponse-3']) && !empty($_POST['reponse-4'])) {

	$question = $_POST['question'];

	//Update question
	$bdd = getDb();
	$requete1 = $bdd->prepare("UPDATE QUESTION SET LibelleQuestion = ? WHERE NumQuestion = ?");
    $requete1->execute(array($question, $question_id));
	
	//Update reponses
	$answers = get_quizz_answers($question_id);
	$indice = 1;
    foreach ($answers as $answer) {
    	$numLibelle = "reponse-" . $indice;
		$libelle = $_POST["$numLibelle"];
		$radio = "radio-reponse-" . $indice;
		$radioReponse = $_POST["$radio"];

		if ($radioReponse == "vrai") {
			$req = $bdd->prepare("UPDATE REPONSE SET Libelle = ?, ValiditeReponse = 1 WHERE NumReponse = ?");
		} else {
			$req = $bdd->prepare("UPDATE REPONSE SET Libelle = ?, ValiditeReponse = 0 WHERE NumReponse = ?");
		}
		$req->execute(array($libelle, $answer["NumReponse"]));
    	
		$indice = $indice + 1;
    }

    $_SESSION['majQuestion'] = "Question bien mise à jour !";
    $location = "modifQuiz.php?quiz_id=".$quiz_id;
	header("Location: $location");
} else {
	if (isset($_POST["premierPassage"])) {
		$_SESSION['erreur'] = "Veuillez remplir tous les champs pour modifier la question";
		unset($_POST["premierPassage"]);
	}
}

?>
<?php 
	require_once "includes/head.php"; 
?>
	<body id="ecran-admin">
		<?php require_once "includes/header.php";
        $url = "modifQRM.php?quiz_id=" . $quiz_id . "&question_id=" . $question_id; 
        ?>
        <?php if (isset($_SESSION['erreur'])) { ?>
            <div class="alert alert-danger">
                <strong>Erreur !</strong> <?= $_SESSION['erreur'] ?>
            </div>
        <?php }
        unset($_SESSION['erreur']); //On nettoie la variable de session "erreur" après l'avoir utilisée (c'est peut être sale attention)
        ?>

		<div id="modif-quiz-container">
		    <form id="modif-question-form" role="form" <?php echo "action='".$url."'"; ?> method="post">
		    	<fieldset class="form-group">
				  	<div class="form-group">
				    	<label for="titre" id="nouvelle-question"><h3>Nouvelle formulation de la question :</h3></label>
				    	<input type="text" class="form-control" id="question" placeholder="Ex : Quelle est la couleur du cheval blanc d'Henry IV ?" name="question">
				  	</div>
				</fieldset>
				<fieldset class="form-group">
				  	<div class="form-group">
				    	<label for="reponse-1" id="reponse-1"><h4>Nouvelle réponse 1: </h4></label>
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
				    	<label for="reponse-2" id="reponse-2"><h4>Nouvelle réponse 2: </h4></label>
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
				    	<label for="reponse-3" id="reponse-3"><h4>Nouvelle réponse 3: </h4></label>
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
				    	<label for="reponse-4" id="reponse-4"><h4>Nouvelle réponse 4: </h4></label>
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
				<input type="hidden" value="premierPassage" name="premierPassage" />
			  	<button type="submit" class="btn" id="modif-quiz-bouton-valider">Valider</button>
			</form>
		</div>
	</body>


