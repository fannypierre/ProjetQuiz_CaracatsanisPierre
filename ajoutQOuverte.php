<?php
	require_once "includes/fonctions.php";
	session_start();
	unset($_SESSION['erreur']); //On nettoie la variable de session "erreur"

if (!empty($_POST['reponse'])) {

	$bdd = getDb();
	//On recupère le numéro de la réponse à insérer par rapport aux autres réponses présentes dans la BD
	$reponses = $bdd->query("Select * from REPONSE");
	$numReponse = -1;
	foreach ($reponses as $reponse) {
		if ($reponse["NumReponse"] > $numReponse) {
			$numReponse = $reponse["NumReponse"];
		}
	}
	$numReponse = $numReponse + 1;

	$bonneReponse = $_POST['reponse'];
	$req = $bdd->prepare('insert into REPONSE (numReponse, Libelle, validiteReponse) values (?, ?, 1)');
    $req->execute(array($numReponse, $bonneReponse));

    $jointure = $bdd->prepare('insert into ASSOCIATIONQR (NumQuestion, NumReponse) values (?, ?)'); //On lie la réponse créée et la question
    $jointure->execute(array($_SESSION['idQuestionModifie'], $numReponse));
    
	$_SESSION['ajoutReponses'] = "ok";
	header('Location: ajoutQuestion.php');

} else { //Si tous les champs n'ont pas été saisis
    $_SESSION['ajoutReponses'] = "champs non remplis";
	$_SESSION['erreur'] = "Veuillez indiquer la réponse";
	$_SESSION['typeQuestion'] = "QOuverte";
    header('Location: ajoutReponse.php');
}
?>