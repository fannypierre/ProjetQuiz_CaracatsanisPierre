<?php
    session_start();
	require_once "includes/fonctions.php";
	//Premiere page du site : inscription/connexion
?>

<html lang="fr">
	
	<?php require_once "includes/head.php";?>
	
	<body>
		<?php require_once "includes/headerConnexion.php";?>
		<?php if (isset($_SESSION['erreur'])) { ?>
            <div class="alert alert-danger">
                <strong>Erreur !</strong> <?= $_SESSION['erreur'] ?>
            </div>
        <?php }
        unset($_SESSION['erreur']); //On nettoie la variable de session "erreur" après l'avoir utilisée
        ?>
	    
	    <div class="container-fluid" id="index">
	    	<div id="phrase-accroche">
	    		<h1>Bienvenue sur Quizzz</h1>
	    		
	    	</div>
	    	
	    	<div id="boutons-connexion">
	    		<a type="button" class="btn btn-outline-dark btn-lg" href="#login">Se connecter</a>
				<a type="button" class="btn btn-outline-dark btn-lg" href="#inscription">S'inscrire</a>

	    	</div>
	    	<div id="index-manuel">
	    		<p>Consulter le <a href="images/manuelUtilisation.pdf" target=”_blank”>manuel d'utilisation du site</a></p>
	    	</div>
		</div>
		<!-- Soit l'utilisateur est déjà enregistré et il décide de se connecter -->
		<div class="login" id="login">
		    <div class="popup-inner">
		    	<img src="images/Logo.svg" width="20%" class="d-inline-block align-top" alt="">
		        <h2>QUIZZZ</h2>
		    	<form id="login-form" role="form" action="login.php" method="post">
				  	<div class="form-group">
				    	<label for="connexion-email" id="connexion-label">Email</label>
				    	<input type="email" class="form-control" id="connexion-email" placeholder="Ex : jdupond@ensc.fr" name="email">
				  	</div>
				 	<div class="form-group">
				    	<label for="connexion-mdp" id="connexion-label">Mot de passe</label>
				    	<input type="password" class="form-control" id="connexion-mdp" name="mdp">
				  	</div>
				  	<button type="submit" class="btn" id="login-bouton-valider">Valider</button>
				</form>
				<a id ="bouton-closepopup" class="closepopup" href="">X</a>
			</div>
		</div>

		<!-- Soit c'est sa première connexion et il s'inscrit -->
		<div class="login" id="inscription">
		    <div class="popup-inner inscription">
		    	<img src="images/Logo.svg" width="20%" class="d-inline-block align-top" alt="">
		        <h2>QUIZZZ</h2>
		    	<form id="inscription-form" role="form" action="inscription.php" method="post">
				  	<div class="form-group">
				    	<label for="inscription-email" id="inscription-label">Email</label>
				    	<input type="email" class="form-control" id="inscription-email" placeholder="Ex : jdupond@ensc.fr" name="email">
				  	</div>
				 	<div class="form-group">
				    	<label for="inscription-mdp" id="inscription-label">Mot de passe</label>
				    	<input type="password" class="form-control" id="inscription-mdp" name="mdp">
				  	</div>
				  	<div class="form-group">
				    	<label for="inscription-confirmation-mdp" id="inscription-label">Confirmez le mot de passe</label>
				    	<input type="password" class="form-control" id="inscription-confirmation-mdp" name="mdp-confirmation">
				  	</div>
				  	<button type="submit" class="btn" id="inscription-bouton-valider">Valider</button>
				</form>
				<a id ="bouton-closepopup" class="closepopup" href="">X</a>
			</div>
		</div>
	</body>
</html>