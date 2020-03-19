<DOCTYPE html>

<?php session_start();?>
<?php if(isset($_SESSION["login"])) $user = $_SESSION["login"]; else $user = "User";?>

<html lang="fr">
	
	<?php require_once "includes/head.php"; ?>
	<?php require_once "includes/header.php"; ?>

    <body>
        <h1>Accueil</h1>

        <div id="conteneur">
            <div class="quiz">
                <p id="title"><strong>Titre</strong></p>
                <div id="contenu">
                    <img src="images/hp.png" width="50%" class="imgDescriptive">
                    <div id="descriptif">
                        <p>Venez tester vos connaissances sur l'univers d'Harry Potter avec ce quiz</p>
                        <button type="button" class="btn btn-danger">Jouer</button>
                    </div>
                </div>
            </div>

            <div class="quiz">
                <p>Titre</p>
                <button type="button" class="btn btn-danger">Jouer</button>
            </div>

            <div class="quiz">
                <p>Titre</p>
                <button type="button" class="btn btn-danger">Jouer</button>
            </div>

            <div class="quiz">
                <p>Titre</p>
                <button type="button" class="btn btn-danger">Jouer</button>
            </div>

            <div class="quiz">
                <p>Titre</p>
                <button type="button" class="btn btn-danger">Jouer</button>
            </div>

            <div class="quiz">
                <p>Titre</p>
                <button type="button" class="btn btn-danger">Jouer</button>
            </div>
        </div>
    </body>
</html>