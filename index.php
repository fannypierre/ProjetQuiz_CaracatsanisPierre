

<?php
	require_once "includes/fonctions.php";
	session_start();

	if (!empty($_POST['email']) and !empty($_POST['mdp'])) {  //ATTENTION DANS LA BD LE CHAMP CORRESPONDANT A L'EMAIL S'APPELLE LOGIN
	    $email = $_POST['email'];
	    $mdp = $_POST['mdp'];
	    $req = getDb()->prepare('select * from utilisateur where Login=? and Mdp=?');
	    $req->execute(array($email, $mdp));

	    if ($req->rowCount() == 1) {
	        $_SESSION['email'] = $email;
	        
	        redirecte("ExempleConnexionBD.php");
	        //redirecte("accueilQuiz.php"); //Diriger vers l'accueil jeu
	    }
	    else {
	        $erreur = "Utilisateur non reconnu";
	    }

	    // $ajout = getDb()->prepare('insert into UTILISATEUR values (?, ?, 0)');
	    // $ajout->execute(array($email, $mdp));

	    //TODO : vérifier la justesse des infos en cas de connexion, insérer les infos en cas d'inscription
	}
?>

<html lang="fr">
	
	<?php require_once "head.php"; ?>
	
	<body>
		<?php require_once "header.php"; ?>
		<?php if (isset($erreur)) { ?>
            <div class="alert alert-danger">
                <strong>Erreur !</strong> <?= $erreur ?>
            </div>
        <?php } ?>
	    
	    <div class="container-fluid" id="index">
	    	<div id="phrase-accroche">
	    		<h1>Phrase d'accroche</h1>
	    	</div>
	    	
	    	<div id="boutons-connexion">
	    		<a type="button" class="btn btn-outline-dark btn-lg" href="#login">Se connecter</a>
				<a type="button" class="btn btn-outline-dark btn-lg" href="#inscription">S'inscrire</a>
	    	</div>
		</div>

		<div class="login" id="login">
		    <div class="popup-inner">
		    	<img src="images/Logo.svg" width="20%" class="d-inline-block align-top" alt="">
		        <h2>QUIZ</h2>
		    	<form id="login-form" role="form" action="index.php" method="post">
				  	<div class="form-group">
				    	<label for="connexion-email" id="connexion-label">Email</label> <!-- !! Récupérer l'email !! -->
				    	<input type="email" class="form-control" id="connexion-email" placeholder="Ex : jdupond@ensc.fr" name="email">
				  	</div>
				 	<div class="form-group">
				    	<label for="connexion-mdp" id="connexion-label">Mot de passe</label> <!-- !! Récupérer le MDP !! -->
				    	<input type="password" class="form-control" id="connexion-mdp" name="mdp">
				  	</div>
				  	<button type="submit" class="btn" id="login-bouton-valider">Valider</button>
				</form>
				<a class="closepopup" href="">X</a>
			</div>
		</div>
		<div class="login" id="inscription">
		    <div class="popup-inner inscription">
		    	<img src="images/Logo.svg" width="20%" class="d-inline-block align-top" alt="">
		        <h2>QUIZ</h2>
		    	<form id="inscription-form" role="form" action="index.php" method="post">
				  	<div class="form-group">
				    	<label for="inscription-email" id="inscription-label">Email</label> <!-- !! Récupérer l'email !! -->
				    	<input type="email" class="form-control" id="inscription-email" placeholder="Ex : jdupond@ensc.fr" name="email">
				  	</div>
				 	<div class="form-group">
				    	<label for="inscription-mdp" id="inscription-label">Mot de passe</label> <!-- !! Récupérer le MDP !! -->
				    	<input type="password" class="form-control" id="inscription-mdp" name="mdp">
				  	</div>
				  	<div class="form-group">
				    	<label for="inscription-confirmation-mdp" id="inscription-label">Confirmez le mot de passe</label>
				    	<input type="password" class="form-control" id="inscription-confirmation-mdp" name="mdp-confirmation">
				  	</div>
				  	<button type="submit" class="btn" id="inscription-bouton-valider">Valider</button>
				</form>
				<a class="closepopup" href="">X</a>
			</div>
		</div>
	</body>
</html>