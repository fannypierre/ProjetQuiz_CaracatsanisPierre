<?php
session_start();
require_once "includes/fonctions.php";
//Code pour l'ajout d'un questionnaire dans la BD et page pour saisir une question à ajouter au questionnaire


if (!empty($_POST['titre']) && !empty($_POST['description-quiz']) && is_uploaded_file($_FILES['image-quiz']['tmp_name'])) {

	//On vérifie si le nom du quiz entré n'est pas trop grand pour qu'il rentre dans la BD
	if (strlen($_POST['titre']) >=40) {
		$_SESSION['erreur'] = "Veuillez choisir un nom de thème moins grand";
		header('Location: nouveauQuiz.php');
	} else {
		$titre = $_POST['titre'];
		$affichage = $_POST['affichage'];
		$description = $_POST['description-quiz'];
		$image = $_FILES['image-quiz']['tmp_name'];

		$bdd = getDb();
		$requete = $bdd->prepare("Select * from QUESTIONNAIRE where Theme=?");
	    $requete->execute(array($titre));

	    if ($requete->rowCount() == 1) { //Si le quiz existe déjà : erreur
	        $_SESSION['erreur'] = "Quiz déjà existant !";
	        header('Location: nouveauQuiz.php');
	    }
	    else { 
	    	//On recupère le numéro du questionnaire à insérer par rapport aux autres quesionnaires présents dans la BD
			$questionnaires = $bdd->query("Select * from QUESTIONNAIRE");
			$numQuestionnaire = -1;
			foreach ($questionnaires as $questionnaire) {
				if ($questionnaire["NumQuestionnaire"] > $numQuestionnaire) {
					$numQuestionnaire = $questionnaire["NumQuestionnaire"];
				}
			}
			$numQuestionnaire = $numQuestionnaire + 1;

		    $req = getDb()->prepare('insert into QUESTIONNAIRE (NumQuestionnaire, Theme, TypeAffichage, Description, Image) values (?, ?, ?, ?, ?)');
		    $req->execute(array($numQuestionnaire, $titre, $affichage, $description, $image));
		    $_SESSION['idQuizModifie'] = $numQuestionnaire; //On sauvegarde la question qu'on est en train de modifier dans une variable de session
		    $_SESSION['titreQuizModifie'] = $titre;
	    }
	}
} else { //Si tous les champs n'ont pas été saisis
	if (!isset($_SESSION['ajoutReponses'])) {
		$_SESSION['erreur'] = "Veuillez saisir tous les champs";
		header('Location: nouveauQuiz.php');
	} else {
		if ($_SESSION['ajoutReponses'] != "ok") {
			$_SESSION['erreur'] = "Veuillez saisir tous les champs";
		}
	}
}

?>
<?php require_once "includes/head.php"; ?>
	<body id="ecran-admin">
		<?php require_once "includes/header.php"; ?>
		<?php if (isset($_SESSION['erreur'])) { ?>
            <div class="alert alert-danger">
                <strong>Erreur !</strong> <?= $_SESSION['erreur'] ?>
            </div>
        <?php
        //unset($_SESSION['erreur']); //On nettoie la variable de session "erreur" après l'avoir utilisée (c'est peut être sale attention)
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
			<h1><?php echo $_SESSION['titreQuizModifie'] ?></h1>
		    <form id="nouveau-quiz-form" role="form" action="ajoutReponse.php" method="post">
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
			<a id="bouton-retour-accueil" href="accueilAdmin.php">Retourner à la page d'accueil des quiz</a>
		</div>
	</body>