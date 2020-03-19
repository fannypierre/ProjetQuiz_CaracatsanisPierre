<DOCTYPE html>

<?php session_start();?>
<?php if(isset($_SESSION["login"])) $user = $_SESSION["login"]; else $user = "User";?>

<html lang="fr">
	
	<?php require_once "head.php"; ?>
	<?php require_once "header.php"; ?>

    <body>
        <h1>Profil</h1>

        <div id="infosPerso">
            <div class="form-group row">
                <label for="staticName" class="col-sm-2 col-form-label">Nom d'utilisateur</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control" id="staticName" value="JDupond">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control" id="staticEmail" value="jdupond@gmail.com">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticMdp" class="col-sm-2 col-form-label">Mot de passe</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control" id="staticMdp" value="??????">
                </div>
            </div>
        </div>
    </body>
</html>