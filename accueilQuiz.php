<?php require_once "connexionBD.php" ?>
<?php session_start(); ?>
<?php if (isset($_SESSION["login"])) $user = $_SESSION["login"];
else $user = "User"; ?>

<DOCTYPE html>

    <html lang="fr">

    <?php require_once "includes/head.php"; ?>
    <?php require_once "includes/header.php"; ?>

    <body>
        <h1>Accueil</h1>


        <div id="conteneur">
            <?php
            $lignes = get_questionnaires();
            if (isset($lignes)) {
                foreach ($lignes as $ligne) {
                    echo "<div class='quiz'>
                            <p class='title'><strong>" . $ligne["Theme"] . "</strong></p>
                            <div class='contenu'>
                                <img src='imageView.php?quiz_id=" . $ligne["NumQuestionnaire"] . "' width='50%' class='imgDescriptive'>
                                    <div class='descriptif'>
                                        <p>" . $ligne["Description"] . "</p>
                                        <a class='btn btn-danger' style='color: white' href='#choixDifficulte'>Jouer</a>
                                    </div>
                            </div>
                        </div>";
                    
                    echo '<div class="login" id="choixDifficulte">
                        <div class="popup-inner">
                            <img src="images/Logo.svg" width="20%" class="d-inline-block align-top" alt="">
                            <h2>QUIZZZ</h2>
                            <form id="difficulte-form" role="form" action="questions.php?quiz_id='.$ligne["NumQuestionnaire"]. '" method="post">
                                <div>
                                    <input type="radio" id="facile" name="difficulte" value="facile" checked>
                                    <label for="facile">Facile</label>
                                </div>
                                <div>
                                    <input type="radio" id="moyen" name="difficulte" value="moyen">
                                    <label for="moyen">Moyen</label>
                                </div>
                                <div>
                                    <input type="radio" id="difficile" name="difficulte" value="difficile">
                                    <label for="difficile">Difficile</label>
                                </div>
                                <button type="submit" class="btn" id="login-bouton-valider">Valider</button>
                            </form>
                            <a id ="bouton-closepopup" class="closepopup" href="">X</a>
                        </div>
                    </div>';
                }
            }
            /*enregistrer ce niveau de difficulté dans $niv_difficulte => $_GET
            dans questions if($niv_difficulte == "facile") { ????}
            else if ($niv_difficulte == "moyen") { ?????}
            else { code actuel}
            */
            
            

            
            ?>
        </div>
    </body>

</html>