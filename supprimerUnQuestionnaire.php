<?php
session_start();	
require_once "includes/fonctions.php";
require_once "connexionBD.php";
//Code pour supprimer un questionnaire entièrement

$quiz_id = $_GET['quiz_id'];

$bdd = getDb();
$questions = get_quizz($quiz_id);

//Pour chaque question associée au quiz...
foreach ($questions as $question) {
	$question_id = $question["NumQuestion"];

	//On supprime d'abord les jointures entre la question et les reponses associees
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
}
//Enfin on supprime le questionnaire
$requete = $bdd->prepare("DELETE FROM QUESTIONNAIRE WHERE NumQuestionnaire = ?");
$requete->execute(array("$quiz_id"));

header("Location: accueilModifQuiz.php");
?>