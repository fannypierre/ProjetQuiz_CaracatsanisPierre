<?php
    session_start();
    require_once "includes/fonctions.php";
    require_once "connexionBD.php";
    //Page de choix de la question à supprimer
    $quiz_id = $_GET['quiz_id'];
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

        <?php 
            //Si on se retrouve sur cette page parce que la question a bien été supprimée on l'indique à l'utilisateur
            if (isset($_SESSION['majQuestion'])) { ?>
                <div class="alert alert-success" role="alert">
                    Question et réponses supprimées !
                </div>
        <?php   
            } unset($_SESSION['majQuestion']);
        ?>

        <?php
            $theme = get_quizz_theme($quiz_id)["Theme"];
            if (isset($theme)) {
                echo "<h1>".$theme."</h1>";
            }
        ?>
        <div id="nouveau-quiz-container">
            <h3>Quelle question voulez-vous supprimer ?</h3>
            <?php
                $lignes = get_quizz($quiz_id);
                if (isset($lignes)) {
                    foreach ($lignes as $ligne) {
                        echo "<a href='supprimerUneQuestion.php?question_id=". $ligne["NumQuestion"] . "&quiz_id=". $quiz_id."' class='list-group-item list-group-item-action'>". $ligne["LibelleQuestion"] ."</a>";
                    }
                    echo "<a id='bouton-suppression-modification' href='modifQuiz.php?quiz_id=". $quiz_id."'>Modifier une question</a>";
                    echo "<a id='bouton-suppression-modification' href='modifAjoutQuestion.php?quiz_id=". $quiz_id."'>Ajouter une question</a>";
                }
            ?>
        </div>
    </body>
</html>