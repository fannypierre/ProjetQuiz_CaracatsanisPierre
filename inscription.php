<?php
	require_once "includes/fonctions.php";
	session_start();
	unset($_SESSION['erreur']); //On nettoie la variable de session "erreur"

	if (!empty($_POST['email']) and !empty($_POST['mdp']) and !empty($_POST['mdp-confirmation'])) { //ATTENTION dans la BD le champ correspondant à l'email s'appelle LOGIN

	    $email = $_POST['email'];
	    $mdp = $_POST['mdp'];
	    $mdpConfirmation = $_POST['mdp-confirmation'];
	    $req = getDb()->prepare('select * from utilisateur where Login=? and Mdp=?');
	    $req->execute(array($email, $mdp));

	    if ($req->rowCount() == 1) { //Si l'utilisateur existe déjà : erreur
	        $_SESSION['erreur'] = "Utilisateur déjà existant !";
	        header('Location: index.php');
	    }
	    else { //Sinon on essaye de l'ajouter à la BD
	    	if ($mdp != $mdpConfirmation) {
	    		$_SESSION['erreur'] = "Erreur : les mots de passe de correspondent pas";
	    		header('Location: index.php'); 
	    	} else {
	    		//$bdd = getDb();
	    		if ($mdp == "LeMotDePasseAdmin") {
	    			$ajout = getDb()->prepare('insert into UTILISATEUR (Login, Mdp, Droits) values (?, ?, 1)');
	    		} else {
	    			$ajout = getDb()->prepare('insert into UTILISATEUR (Login, Mdp, Droits) values (?, ?, 0)');
	    		}
	    		$ajout->execute(array($email, $mdp));
	    		$_SESSION['email'] = $email;
	    		header('Location: accueilQuiz.php');
	    	}
	    }
	} else {
		$_SESSION['erreur'] = "Veuillez remplir tous les champs";
    	header('Location: index.php');
	}
?>