<?php
	require_once "includes/fonctions.php";
	session_start();
?>

<html lang="fr">
	
	<?php require_once "includes/head.php"; ?>
	
	<body id="ecran-admin">
		<?php require_once "includes/header.php"; ?>
		<?php if (isset($_SESSION['erreur'])) { ?>
            <div class="alert alert-danger">
                <strong>Erreur !</strong> <?= $_SESSION['erreur'] ?>
            </div>
        <?php 
        unset($_SESSION['erreur']); } //On nettoie la variable de session "erreur" après l'avoir utilisée (c'est peut être sale attention)
        ?>
        <div id="nouveau-quiz-container">
	        <h1>Nouveau quiz</h1>
			<form enctype="multipart/form-data" id="nouveau-quiz-form" role="form" action="ajoutQuestion.php" method="post">
				<fieldset class="form-group">
				  	<div class="form-group">
				    	<label for="titre" id="nouveau-quiz-titre"><h3>Titre du quiz :</h3></label>
				    	<input type="text" class="form-control" id="titre" placeholder="Ex : Harry Potter" name="titre">
				  	</div>
				</fieldset>
			  	<fieldset class="form-group">
			  		<h5>Type d'affichage : </h5>
				  	<div class="form-check form-check-inline">
					  	<input class="form-check-input" type="radio" name="affichage" id="affichage-scinde" value="scinde" checked>
					  	<label class="form-check-label" for="scinde">Scindé</label>
					</div>
					<div class="form-check form-check-inline">
					  	<input class="form-check-input" type="radio" name="affichage" id="affichage-continu" value="continu">
					  	<label class="form-check-label" for="continu">Continu</label>
					</div>
				</fieldset>
				<fieldset class="form-group">
				  	<div class="form-group">
				    	<label for="description-quiz"><h5>Description du quiz :</h5></label>
				    	<input type="text" class="form-control" id="description-quiz" name="description-quiz">
				  	</div>
				</fieldset>
				<fieldset>
					<h5> Image du quiz : </h5>
					<label class="form-check-label" for="image-quiz">Sélectionnez une image pour votre quiz</label>
					<input type="hidden" name="MAX_FILE_SIZE" value="250000" />
         			<input type="file" name="image-quiz" size=50 />
				</fieldset>
				<br/>
			  	<button type="submit" class="btn" id="nouveau-quiz-bouton-valider">Valider</button>
			</form>
		</div>
	</body>
</html>