<?php
	require_once "includes/fonctions.php";
	session_start();
	unset($_SESSION['erreur']); //On nettoie la variable de session "erreur"

	if ( !empty($_POST['email']) and !empty($_POST['mdp']) ) {
	    $email = $_POST['email'];
	    $mdp = $_POST['mdp'];
	    $req = getDb()->prepare('select * from utilisateur where Login=? and Mdp=?');
	    $req->execute(array($email, $mdp));

	    if ($req->rowCount() == 1) {
	        $_SESSION['email'] = $email;
	        header('Location: accueilQuiz.php');
	    }
	    else {
	        $_SESSION['erreur'] = "Utilisateur non reconnu";
	        header('Location: index.php');
	    }
	} else { //Si tous les champs n'ont pas été saisis
		$_SESSION['erreur'] = "Veuillez remplir tous les champs";
	    header('Location: index.php');
	}
?>