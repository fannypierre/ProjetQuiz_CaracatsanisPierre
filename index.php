<!DOCTYPE html>

<?php session_start();?>
<?php if(isset($_SESSION["login"])) $user = $_SESSION["login"]; else $user = "User";?>

<html lang="fr">
	
	<?php require_once "head.php"; ?>
	<?php require_once "header.php"; ?>
	<body>
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
		    	<form id="login-form">
				  	<div class="form-group">
				    	<label for="connexion-email" id="connexion-label">Email</label> <!-- !! Récupérer l'email !! -->
				    	<input type="email" class="form-control" id="connexion-email" placeholder="Ex : jdupond@ensc.fr">
				  	</div>
				 	<div class="form-group">
				    	<label for="connexion-mdp" id="connexion-label">Mot de passe</label> <!-- !! Récupérer le MDP !! -->
				    	<input type="password" class="form-control" id="connexion-mdp">
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
		    	<form id="inscription-form">
				  	<div class="form-group">
				    	<label for="inscription-email" id="inscription-label">Email</label> <!-- !! Récupérer l'email !! -->
				    	<input type="email" class="form-control" id="inscription-email" placeholder="Ex : jdupond@ensc.fr">
				  	</div>
				 	<div class="form-group">
				    	<label for="inscription-mdp" id="inscription-label">Mot de passe</label> <!-- !! Récupérer le MDP !! -->
				    	<input type="password" class="form-control" id="inscription-mdp">
				  	</div>
				  	<div class="form-group">
				    	<label for="inscription-confirmation-mdp" id="inscription-label">Confirmez le mot de passe</label>
				    	<input type="password" class="form-control" id="inscription-confirmation-mdp">
				  	</div>
				  	<button type="submit" class="btn" id="inscription-bouton-valider">Valider</button>
				</form>
				<a class="closepopup" href="">X</a>
			</div>
		</div>
	</body>
</html>