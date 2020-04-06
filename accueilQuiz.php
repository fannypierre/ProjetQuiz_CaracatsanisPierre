<DOCTYPE html>
    <?php require_once "connexionBD.php" ?>
    <?php session_start(); ?>
    <?php if (isset($_SESSION["login"])) $user = $_SESSION["login"];
    else $user = "User"; ?>

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
            ?>


            <div class="quiz">
                <p id="title"><strong>Titre</strong></p>
                <div id="contenu">
                    <img src="images/hp.png" width="50%" class="imgDescriptive">
                    <div id="descriptif">
                        <p>Venez tester vos connaissances sur l'univers d'Harry Potter avec ce quiz</p>
                        <form name="jouer" action="questions.php" method="post">
                            <button type="submit" class="btn btn-danger">Jouer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>