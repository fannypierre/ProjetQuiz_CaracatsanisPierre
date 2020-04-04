<?php
	require_once "includes/fonctions.php";
	session_start();
?>

<html lang="fr">
	
	<?php require_once "includes/head.php"; ?>
	
	<body>
		<?php require_once "includes/header.php";?>

        <?php if (isset($_SESSION['erreur'])) { ?>
            <div class="alert alert-danger">
                <strong>Erreur !</strong> <?= $_SESSION['erreur'] ?>
            </div>
        <?php }
        unset($_SESSION['erreur']); //On nettoie la variable de session "erreur" après l'avoir utilisée (c'est peut être sale attention)
        ?>

	    <?php if (isset($_SESSION['majMdp'])) { ?>
	    		<div class="alert alert-success" role="alert">
				  	Mise à jour du mot de passe effectuée !
				</div>
		<?php		
			} unset($_SESSION['majMdp']);
		?>

        <div id="profilJoueur-container">

	        <h1>Votre profil</h1>
			
			<h3> Login : <?php echo $_SESSION["email"]; ?></h3>

			<form id="nouveauMdp-form" role="form" action="nouveauMdp.php" method="post">
			 	<div class="form-group">
			    	<label for="nouveauMdp-mdp" id="nouveauMdp-label">Nouveau mot de passe</label>
			    	<input type="password" class="form-control" id="nouveauMdp-mdp" name="mdp">
			  	</div>
			  	<div class="form-group">
			    	<label for="nouveauMdp-confirmation-mdp" id="nouveauMdp-label">Confirmez le mot de passe</label>
			    	<input type="password" class="form-control" id="nouveauMdp-confirmation-mdp" name="mdp-confirmation">
			  	</div>
			  	<button type="submit" class="btn" id="nouveauMdp-bouton-valider">Valider</button>
			</form>
		</div>
	</body>
</html>