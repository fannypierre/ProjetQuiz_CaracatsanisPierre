<?php
    session_start();
    //Page d'accueil administrateur : possibilité d'ajouter/modifier/Supprimer un quiz
	require_once "includes/fonctions.php";
?>

<html lang="fr">
	
	<?php require_once "includes/head.php"; ?>
	
	<body id="ecran-admin">
		<?php require_once "includes/header.php"; ?>
        <div id="accueil-admin">
	        <h1>Bienvenue sur l'accueil administrateur. Que voulez-vous faire ?</h1>
	        <div id="accueil-admin-bouttons">
				<a href="nouveauQuiz.php" class="badge">Créer un nouveau quiz</a>
				<a href="accueilModifQuiz.php" class="badge">Modifier un ancien quiz</a>
				<a href="supprimerQuestionnaire.php" class="badge">Supprimer un quiz</a>
			</div>
		</div>
	</body>
</html>