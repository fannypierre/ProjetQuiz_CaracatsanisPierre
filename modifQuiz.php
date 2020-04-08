<?php
    session_start();
    require_once "includes/fonctions.php";
    require_once "connexionBD.php";
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
            if (isset($_SESSION['majQuestion'])) { ?>
                <div class="alert alert-success" role="alert">
                    Question et réponses mises à jour !
                </div>
        <?php   
            } unset($_SESSION['majQuestion']);
        ?>
        <?php 
            if (isset($_SESSION['ajoutReponses']) && $_SESSION['ajoutReponses']=="ok") { ?>
                <div class="alert alert-success" role="alert">
                    Question et réponses ajoutées !
                </div>
        <?php   
            } unset($_SESSION['ajoutReponses']);
        ?>

        <?php
            $theme = get_quizz_theme($quiz_id)["Theme"];
            if (isset($theme)) {
                echo "<h1>".$theme."</h1>";
            }
        ?>
        <div id="nouveau-quiz-container">
            <h3>Quelle question voulez-vous modifier ?</h3>
            <?php
                $lignes = get_quizz($quiz_id);
                if (isset($lignes)) {
                    foreach ($lignes as $ligne) {
                        switch ($ligne["Type"]) {
                            case "QOuverte":
                                echo "<a href='modifQOuverte.php?question_id=". $ligne["NumQuestion"] . "&quiz_id=". $quiz_id."' class='list-group-item list-group-item-action'>". $ligne["LibelleQuestion"] ."</a>";
                                break;
                            case "QRU":
                                echo "<a href='modifQRU.php?question_id=". $ligne["NumQuestion"] . "&quiz_id=". $quiz_id."' class='list-group-item list-group-item-action'>". $ligne["LibelleQuestion"] ."</a>";
                                break;
                            case "QRM":
                                echo "<a href='modifQRM.php?question_id=". $ligne["NumQuestion"] . "&quiz_id=". $quiz_id."' class='list-group-item list-group-item-action'>". $ligne["LibelleQuestion"] ."</a>";
                                break;
                        }
                    }
                    echo "<a id='bouton-suppression-modification' href='supprimerQuestions.php?question_id=". $ligne["NumQuestion"] . "&quiz_id=". $quiz_id."'>Supprimer une question</a>";
                    echo "<a id='bouton-suppression-modification' href='modifAjoutQuestion.php?quiz_id=". $quiz_id."'>Ajouter une question</a>";
                }
            ?>
        </div>
    </body>
</html>