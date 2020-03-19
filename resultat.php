<DOCTYPE html>

<?php session_start();?>
<?php if(isset($_SESSION["login"])) $user = $_SESSION["login"]; else $user = "User";?>

<html lang="fr">
	
	<?php require_once "head.php"; ?>
	<?php require_once "header.php"; ?>

    <body>
        <h1>Titre</h1>

        <div id="res">
            <p>Félicitations, votre score est</p>
            <p>Resultat à récupérer sur la bd</p>
            <p>Vous pouvez <a href="questions.php">refaire ce quiz</a> ou <a href="accueilQuiz.php">retourner à la page d'accueil</a></p>
        </div>
    </body>
</html>