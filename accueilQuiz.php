<?php session_start(); ?>
<?php require_once "connexionBD.php"; ?>
<?php if (isset($_SESSION["email"])) $user = $_SESSION["email"];
else $user = "User"; ?>

<DOCTYPE html>

    <html lang="fr">

    <?php require_once "includes/head.php"; ?>
    <?php require_once "includes/header.php"; ?>

    <body>
        <h1>Accueil</h1>

        <div id="conteneur">
            <?php
            //Affichage de tous les questionnaires sur la page d'accueil
            $lignes = get_questionnaires();
            if (isset($lignes)) {
                foreach ($lignes as $ligne) {
                    echo "<div class='quiz'>
                            <p class='title'><strong>" . $ligne["Theme"] . "</strong></p>
                            <div class='contenu'>
                                <img src='imageView.php?quiz_id=" . $ligne["NumQuestionnaire"] . "' width='50%' class='imgDescriptive'>
                                    <div class='descriptif'>
                                        <p>" . $ligne["Description"] . "</p>
                                        <a class='btn btn-danger' style='color: white' href='#choixDifficulte?quiz_id=".$ligne["NumQuestionnaire"]."'>Jouer</a>
                                    </div>
                            </div>
                        </div>";
                    
                    /*Pop-up permettant de choisir la difficulté du quiz sélectionné 
                    Récupération du niveau de difficulté grâce à la méthode POST et de l'id du quiz grâce à la méthode GET
                    */
                    echo "<div class='login' id='choixDifficulte?quiz_id=".$ligne["NumQuestionnaire"]."'>
                        <div class='popup-inner'>
                            <img src='images/Logo.svg' width='20%' class='d-inline-block align-top' alt=''>
                            <h2>QUIZZZ</h2>
                             <form id='difficulte-form' role='form' action='questions.php?quiz_id=".$ligne["NumQuestionnaire"]."' method='post'>
                                <div>
                                    <input type='radio' id='facile' name='difficulte' value='facile' checked>
                                    <label for='facile'>Facile</label>
                                </div>
                                <div>
                                    <input type='radio' id='moyen' name='difficulte' value='moyen'>
                                    <label for='moyen'>Moyen</label>
                                </div>
                                <div>
                                    <input type='radio' id='difficile' name='difficulte' value='difficile'>
                                    <label for='difficile'>Difficile</label>
                                </div>
                                </br>
                                <button type='submit' class='btn btn-light' width='50%'>Valider</button>
                            </form>
                            <a id ='bouton-closepopup' class='closepopup' href=''>X</a>
                        </div>
                    </div>";
                }
            }
            ?>
        </div>
    </body>

</html>