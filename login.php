<?php
    session_start();
	require_once "includes/fonctions.php";
	unset($_SESSION['erreur']); //On nettoie la variable de session "erreur"

	//On vérifie que les champs ont bien été remplis
	if ( !empty($_POST['email']) and !empty($_POST['mdp']) ) {
	    $email = $_POST['email'];
	    $mdp = $_POST['mdp'];
	    $req = getDb()->prepare('select * from UTILISATEUR where Login=? and Mdp=?');
	    $req->execute(array($email, $mdp));
	    //Si l'utilisateur existe bien
	    if ($req->rowCount() == 1) {
	        $_SESSION['email'] = $email;
	        header('Location: accueilQuiz.php');
	    }
	    else { //Sinon on l'indique à l'utilisateur et on annule l'opération
	        $_SESSION['erreur'] = "Utilisateur non reconnu";
	        header('Location: index.php');
	    }
	} else { //Si tous les champs n'ont pas été saisis
		$_SESSION['erreur'] = "Veuillez remplir tous les champs";
	    header('Location: index.php');
	}
?>