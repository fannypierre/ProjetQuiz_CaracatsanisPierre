<!-- Page du profil de l'utilsateur -->
<?php
	require_once "includes/fonctions.php";
	session_start();

	$estAdmin = false;

	//On vérifie si l'utilisateur est un administrateur (pour changer au besoin l'apparence de la fenetre)
	if (isset($_SESSION["email"])) {
		$bdd = getDb();
		$requete = $bdd->prepare("SELECT * FROM UTILISATEUR WHERE Login = ?");
		$utilisateur = $requete->execute(array($_SESSION["email"]));

		$utilisateur = $utilisateur ? $requete->fetch() : null;

		if ($requete->rowCount() == 1) {
	        if ($utilisateur["Droits"] == 1) {
	        	$estAdmin = true;
	        }
	    }
	} else {
		header('Location: index.php');
	}
?>

<html lang="fr">
	
	<?php 
		require_once "includes/head.php";

		//On modifie l'affiche selon les droits de l'utilisateur
		if ($estAdmin) {
			?>
				<body id='ecran-admin'>
			<?php
		} else {
			?>
				<body>
			<?php
		}
	?>

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

			<!-- Formulaire pour changer le mot de passe de l'utilisateur -->
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
			<?php
				//Si l'utilisateur est un administrateur il peut accéder à la page de gestion des questionnaires
				if ($estAdmin) {
					?>
						<a id='bouton-suppression-modification' href='accueilAdmin.php'>Gestion des questionnaires</a>
					<?php
				}
			?>
		</div>
	</body>
</html>