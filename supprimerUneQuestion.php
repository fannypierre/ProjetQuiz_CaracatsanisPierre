<!-- Code pour supprimer une question et les réponses associées -->
<?php
session_start();	
require_once "includes/fonctions.php";
require_once "connexionBD.php";

$question_id = $_GET['question_id'];
$quiz_id = $_GET['quiz_id'];

$bdd = getDb();

//On supprime d'abord jointures entre question et reponse puis les réponses
$answers = get_quizz_answers($question_id);

foreach ($answers as $answer) {
	$requete = $bdd->prepare("DELETE FROM ASSOCIATIONQR WHERE NumReponse = ?");
	$requete->execute(array($answer["NumReponse"]));

	$requete = $bdd->prepare("DELETE FROM REPONSE WHERE NumReponse = ?");
	$requete->execute(array($answer["NumReponse"]));
}

//Puis on supprime la jointure entre Question et Questionnaire
$requete = $bdd->prepare("DELETE FROM ASSOCIATIONQQ WHERE NumQuestion = ?");
$requete->execute(array("$question_id"));

//Et enfin on supprime la question
$requete = $bdd->prepare("DELETE FROM QUESTION WHERE NumQuestion = ?");
$requete->execute(array("$question_id"));

$location = "modifQuiz.php?quiz_id=".$quiz_id;
	header("Location: $location");
?>