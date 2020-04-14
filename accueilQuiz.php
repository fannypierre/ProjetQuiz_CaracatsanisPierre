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
                                    <a class='btn btn-danger' style='color: white' href='questions.php?quiz_id=" . $ligne["NumQuestionnaire"] . "'>Jouer</a>
                                    </div></div></div>";
                }
            }

            /*faire un pop up, radio button, sélection du niveau de difficulté
            enregistrer ce niveau de difficulté dans $niv_difficulte => $_GET
            dans questions if($niv_difficulte == "facile") { ????}
            else if ($niv_difficulte == "moyen") { ?????}
            else { code actuel}
            */

            ?>
        </div>
    </body>

</html>