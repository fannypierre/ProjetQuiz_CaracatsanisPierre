<!-- Code pour l'ajout d'une question dans la bd -->
<?php
	require_once "includes/fonctions.php";
	session_start();
	unset($_SESSION['erreur']); //On nettoie la variable de session "erreur"

if (!empty($_POST['question'])) {

	$bdd = getDb();
	//On recupère le numéro de la question à insérer par rapport aux autres quesionnaires présents dans la BD
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

    $req = getDb()->prepare('insert into QUESTION (NumQuestion, Type, LibelleQuestion) values (?, ?, ?)');
    $req->execute(array($numQuestion, $typeQuestion, $libelle));

    $jointure = getDb()->prepare('insert into ASSOCIATIONQQ (NumQuestionnaire, NumQuestion) values (?, ?)'); //On lie la question créée et le questionnaire
    $jointure->execute(array($_SESSION['idQuestionModifie'], $numQuestion));

    $_SESSION['idQuestionModifie'] = $numQuestion;

} else { //Si tous les champs n'ont pas été saisis
	$_SESSION['erreur'] = "Veuillez proposer une question...";
    header('Location: ajoutQuestion.php');
}
?>