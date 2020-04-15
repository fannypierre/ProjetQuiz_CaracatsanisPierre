<!-- Page pour choisir quel quiz modifier -->
<?php
	session_start();
	require_once "includes/fonctions.php";
	require_once "connexionBD.php";
?>

<html lang="fr">
	
	<?php require_once "includes/head.php"; ?>
	
	<body id="ecran-admin">
		<?php require_once "includes/header.php"; ?>
        
        <div id="nouveau-quiz-container">
	        <h1>Quel quiz voulez-vous modifier ?</h1>
	        <div class="list-group">
		        <?php
		            $lignes = get_questionnaires();
		            if (isset($lignes)) {
		                foreach ($lignes as $ligne) {
                        	echo "<a href='modifQuiz.php?quiz_id=". $ligne["NumQuestionnaire"] . "' class='list-group-item list-group-item-action'>". $ligne["Theme"] ."</a>";
                    	}
		            }
		        ?>
	    	</div>
	    	<a id='bouton-suppression-modification' href='supprimerQuestionnaire.php'>Supprimer un questionnaire</a>
            <a id='bouton-suppression-modification' href='nouveauQuiz.php'>Ajouter un questionnaire</a>
        </div>
	</body>
</html>