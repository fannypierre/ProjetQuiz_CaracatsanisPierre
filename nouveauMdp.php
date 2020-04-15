<!-- Code d'enregistrement du nouveau mot de passe utilisateur -->
<?php
	require_once "includes/fonctions.php";
	session_start();
	unset($_SESSION['erreur']); //On nettoie la variable de session "erreur"

	if (!empty($_POST['mdp']) and !empty($_POST['mdp-confirmation'])) {

	    $mdp = $_POST['mdp'];
	    $mdpConfirmation = $_POST['mdp-confirmation'];

	    if ($mdp == $mdpConfirmation) {
	    	$req = getDb()->prepare('update UTILIATEUR set Mdp = ? where Login = ?');
	    	$req->execute(array($mdp, $_SESSION['email']));
	    	$_SESSION['majMdp'] = "maj Mdp";
	    } else {
			$_SESSION['erreur'] = "Les mots de passe ne correspondent pas";
    		header('Location: profilJoueur.php');
	    }	    
	} else {
		$_SESSION['erreur'] = "Veuillez remplir tous les champs";
    	header('Location: profilJoueur.php');
	}
?>