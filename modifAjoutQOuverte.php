<!-- Code pour l'ajout de la réponse à une QOuverte, dans le cas de l'ajout de la question et non de sa modification -->
<?php
	require_once "includes/fonctions.php";
	session_start();

$quiz_id = $_GET["quiz_id"];

if (!empty($_POST['reponse'])) {

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

	//On ajoute la réponse dans la BD
	$bonneReponse = $_POST['reponse'];
	$req = $bdd->prepare('insert into REPONSE (numReponse, Libelle, validiteReponse) values (?, ?, 1)');
    $req->execute(array($numReponse, $bonneReponse));

    $jointure = $bdd->prepare('insert into ASSOCIATIONQR (NumQuestion, NumReponse) values (?, ?)'); //On lie la réponse créée et la question
    $jointure->execute(array($_SESSION['idQuestionModifie'], $numReponse));

    //C'est bon, on peut retourner à la page de modification du quiz
	$_SESSION['ajoutReponses'] = "ok";
	$location = "modifQuiz.php?quiz_id=".$quiz_id;
	header("Location: $location");

} else { //Si tous les champs n'ont pas été saisis
	$_SESSION['ajoutReponses'] = "champs non remplis";
	$_SESSION['erreur'] = "Veuillez saisir la bonne réponse";
	$_SESSION['typeQuestion'] = "QOuverte";
    $location = "modifAjoutReponse.php?quiz_id=".$quiz_id;
	header("Location: $location");
}
?>