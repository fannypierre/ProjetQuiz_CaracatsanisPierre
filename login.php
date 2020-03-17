<?php require_once "head.php"; ?>
<?php require_once "header.php"; ?>


<?php
require_once "includes/fonctions.php";
session_start();

if (!empty($_POST['email']) and !empty($_POST['mdp'])) {  //ATTENTION DANS LA BD LE CHAMP CORRESPONDANT A L'EMAIL S'APPELLE LOGIN
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $req = getDb()->prepare('select * from utilisateur where Login=? and Mdp=?');
    $req->execute(array($email, $mdp));

    if ($req->rowCount() == 1) {
        $_SESSION['email'] = $email;
        redirecte("ExempleConnexionBD.php"); //Diriger vers l'accueil jeu
    }
    else {
        $error = "Utilisateur non reconnu";
        redirecte("index.php")
    }
} else {
	echo "ca marche pas";
	redirecte("ExempleConnexionBD.php")
}
?>