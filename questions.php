<DOCTYPE html>

<?php session_start();?>
<?php if(isset($_SESSION["login"])) $user = $_SESSION["login"]; else $user = "User";?>

<html lang="fr">
	
	<?php require_once "head.php"; ?>
	<?php require_once "header.php"; ?>

    <body>
        <h1>Titre</h1>

        <form id="questionnaire">
            <div class="form-group">
                <label for="question1">Question 1</label>
                <input type="email" class="form-control" id="question1">
            <div class="form-group">
                <label for="question2">Question 2</label>
                <select class="form-control" id="question2">
                <option>Réponse 1</option>
                <option>Réponse 2</option>
                <option>Réponse 3</option>
                <option>Réponse 4</option>
                <option>Réponse 5</option>
                </select>
            </div>
            <div class="form-group">
                <label for="question3">Question 3</label>
                <textarea class="form-control" id="question3" rows="3"></textarea>
            </div>
                <label for="question4">Question 4</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="question4_Reponse1">
                    <label class="form-check-label" for="question4_Reponse1">Réponse 1</label>
                </div>
                <div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="question4_Reponse2">
                    <label class="form-check-label" for="question4_Reponse2">Réponse 2</label>
                </div>
            </div>
            </div>
                <label for="question5">Question 5</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="question5_Reponse1" value="option1" checked>
                    <label class="form-check-label" for="question5_Reponse1">Réponse 1</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="question5_Reponse2" value="option2">
                    <label class="form-check-label" for="question5_Reponse2">Réponse 2</label>
                </div>
            </div>
            </br>
            <button type="submit" class="btn btn-danger">Valider</button>
        </form>

    </body>
</html>