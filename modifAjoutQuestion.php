<?php
session_start();
require_once "includes/fonctions.php";
require_once "connexionBD.php";
//Page pour indiquer les informations concernant la question à ajouter à un quiz donné

$quiz_id = $_GET['quiz_id'];
?>
<?php require_once "includes/head.php"; ?>
	<body id="ecran-admin">
		<?php require_once "includes/header.php"; ?>
		<?php if (isset($_SESSION['erreur'])) { ?>
            <div class="alert alert-danger">
                <strong>Erreur !</strong> <?= $_SESSION['erreur'] ?>
            </div>
        <?php
        unset($_SESSION['erreur']); //On nettoie la variable de session "erreur" après l'avoir utilisée (c'est peut être sale attention)
        }
        ?>

	    <?php if (isset($_SESSION['ajoutReponses'])) {
	    		if ($_SESSION['ajoutReponses'] == "ok") {?>
				    <div class="alert alert-success" role="alert">
					  	Question et réponses ajoutées avec succès !
					</div>
		<?php 	}
			} unset($_SESSION['ajoutReponses']);
		?>

		<div id="nouveau-quiz-container">
			<h1><?php echo get_quizz_theme($quiz_id)["Theme"]; ?></h1>
			

		    <form id="nouveau-quiz-form" role="form" <?php echo "action='modifAjoutReponse.php?quiz_id=".$quiz_id."'"; ?> method="post">
				<fieldset class="form-group">
				  	<div class="form-group">
				    	<label for="titre" id="nouvelle-question"><h3>Question à ajouter :</h3></label>
				    	<input type="text" class="form-control" id="question" placeholder="Ex : Quelle est la couleur du cheval blanc d'Henry IV ?" name="question">
				  	</div>
				</fieldset>
			  	<fieldset class="form-group">
			  		<h5>Type de question :</h5>
				  	<div class="form-check form-check-inline">
					  	<input class="form-check-input" type="radio" name="typeQuestion" id="QRU" value="QRU" checked>
					  	<label class="form-check-label" for="QRU">Question à réponse unique (QRU)</label>
					</div>
					<div class="form-check form-check-inline">
					  	<input class="form-check-input" type="radio" name="typeQuestion" id="QRM" value="QRM">
					  	<label class="form-check-label" for="QRM">Question à réponses multiples (QRM)</label>
					</div>
					<div class="form-check form-check-inline">
					  	<input class="form-check-input" type="radio" name="typeQuestion" id="QOuverte" value="QOuverte">
					  	<label class="form-check-label" for="QOuverte">Question ouverte (QOuverte)</label>
					</div>
				</fieldset>
			  	<button type="submit" class="btn" id="nouveau-quiz-bouton-valider">Valider</button>
			</form>
		</div>
	</body>