<?php
    session_start();
    //Code pour l'ajout des réponses à une QRM
	require_once "includes/fonctions.php";
	unset($_SESSION['erreur']); //On nettoie la variable de session "erreur"

if (!empty($_POST['reponse-1']) && !empty($_POST['reponse-2']) && !empty($_POST['reponse-3']) && !empty($_POST['reponse-4'])) {

	$bdd = getDb();
	//On recupère le numéro de la réponse à insérer par rapport aux autres réponses présentes dans la BD
	$reponses = $bdd->query("Select * from REPONSE");
	$numReponse = -1;
	foreach ($reponses as $reponse) {
		if ($reponse["NumReponse"] > $numReponse) {
			$numReponse = $reponse["NumReponse"];
		}
	}
	
	for ($i=1; $i < 5; $i++) { //On ajoute les réponses à la BD
		$numReponse = $numReponse + 1;
		
		$numLibelle = "reponse-" . $i;
		$libelle = $_POST["$numLibelle"];

		$radio = "radio-reponse-" . $i;
		$radioReponse = $_POST["$radio"];
		if ($_POST[$radio] == "vrai") {
			$req = $bdd->prepare('insert into REPONSE (numReponse, Libelle, validiteReponse) values (?, ?, 1)');
		} else {
			$req = $bdd->prepare('insert into REPONSE (numReponse, Libelle, validiteReponse) values (?, ?, 0)');
		}

		// echo "num : " . $numReponse;
		// echo "libelle : " . $libelle;
	    $req->execute(array($numReponse, $libelle));
	    $jointure = $bdd->prepare('insert into ASSOCIATIONQR (NumQuestion, NumReponse) values (?, ?)'); //On lie la réponse créée et la question
	    $jointure->execute(array($_SESSION['idQuestionModifie'], $numReponse));
	}
	$_SESSION['ajoutReponses'] = "ok";
	header('Location: ajoutQuestion.php');

} else { //Si tous les champs n'ont pas été saisis
	$_SESSION['ajoutReponses'] = "champs non remplis";
	$_SESSION['erreur'] = "Veuillez remplir tous les champs";
	$_SESSION['typeQuestion'] = "QRM";
    header('Location: ajoutReponse.php');
}
?>