<!-- Page de choix de suppression d'un questionnaire -->
<?php
    session_start();
    require_once "includes/fonctions.php";
    require_once "connexionBD.php";
?>

<html lang="fr">
    
    <?php require_once "includes/head.php"; ?>
    
    <body id="ecran-admin">
        <?php require_once "includes/header.php"; ?>
        <?php 
            if (isset($_SESSION['erreur'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <strong>Erreur !</strong> <?= $_SESSION['erreur'] ?>
                </div>
        <?php   
            } unset($_SESSION['erreur']);
        ?>
        <div id="nouveau-quiz-container">
            <h3>Quel questionnaire voulez-vous supprimer ?</h3>
            <?php
                $lignes = get_questionnaires();
                if (isset($lignes)) {
                    foreach ($lignes as $ligne) {
                        echo "<a href='supprimerUnQuestionnaire.php?quiz_id=". $ligne["NumQuestionnaire"]."' class='list-group-item list-group-item-action'>". $ligne["Theme"] ."</a>";
                    }
                }
                echo "<a id='bouton-suppression-modification' href='accueilModifQuiz.php'>Modifier un questionnaire</a>";
                echo "<a id='bouton-suppression-modification' href='nouveauQuiz.php'>Ajouter un questionnaire</a>";
            ?>
        </div>
    </body>
</html>