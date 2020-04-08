<?php
	require_once "includes/fonctions.php";
	session_start();

$quiz_id = $_GET["quiz_id"];

if (!empty($_POST['bonne-reponse']) && !empty($_POST['mauvaise-reponse-1']) && !empty($_POST['mauvaise-reponse-2']) && !empty($_POST['mauvaise-reponse-3'])) {

	unset($_SESSION['erreur']);
	$bdd = getDb();
	//On recupère le numéro de la question à insérer par rapport aux autres réponses présentes dans la BD
	$reponses = $bdd->query("Select * from REPONSE");
	$numReponse = -1;
	foreach ($reponses as $reponse) {
		if ($reponse["NumReponse"] > $numReponse) {
			$numReponse = $reponse["NumReponse"];
		}
	}
	$numReponse = $numReponse + 1;

	$bonneReponse = $_POST['bonne-reponse'];
	$req = $bdd->prepare('insert into REPONSE (numReponse, Libelle, validiteReponse) values (?, ?, 1)');
    $req->execute(array($numReponse, $bonneReponse));

    $jointure = $bdd->prepare('insert into ASSOCIATIONQR (NumQuestion, NumReponse) values (?, ?)'); //On lie la réponse créée et la question
    
    $jointure->execute(array($_SESSION['idQuestionModifie'], $numReponse));

	for ($i=1; $i < 4; $i++) { //On ajoute les 3 mauvaise réponses
		$numReponse = $numReponse + 1;
		$mauvaiseReponse = "mauvaise-reponse-" . $i;
		$mauvaise = $_POST[$mauvaiseReponse];

		$req = $bdd->prepare('insert into REPONSE (numReponse, Libelle, validiteReponse) values (?, ?, 0)');
	    $req->execute(array($numReponse, $mauvaise));

	    $jointure = $bdd->prepare('insert into ASSOCIATIONQR (NumQuestion, NumReponse) values (?, ?)'); //On lie la réponse créée et la question
	    $jointure->execute(array($_SESSION['idQuestionModifie'], $numReponse));
	}
	$_SESSION['ajoutReponses'] = "ok";
	$location = "modifQuiz.php?quiz_id=".$quiz_id;
	header("Location: $location");

} else { //Si tous les champs n'ont pas été saisis
	$_SESSION['ajoutReponses'] = "champs non remplis";
	$_SESSION['erreur'] = "Veuillez remplir tous les champs";
	$_SESSION['typeQuestion'] = "QRU";
    $location = "modifAjoutReponse.php?quiz_id=".$quiz_id;
	header("Location: $location");
}
?>