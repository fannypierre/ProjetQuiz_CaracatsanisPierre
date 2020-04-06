<!DOCTYPE html>

<?php
require_once "connexionBD.php";
session_start();
if (isset($_SESSION["login"])) $user = $_SESSION["login"];
else $user = "User";

$quizz_id = $_GET['quiz_id'];
?>

<html lang="fr">

<?php require_once "includes/head.php";
require_once "includes/header.php"; ?>

<body>

    <?php
    $theme = get_quizz_theme($quizz_id)["Theme"];
    if (isset($theme)) {
        echo "<h1>".$theme."</h1>";
    }
    ?>

    <form id="questionnaire" action="resultat.php" method="post">
        <?php
        $lignes = get_quizz($quizz_id);
        if (isset($lignes)) {
            $index = 1;
            foreach ($lignes as $ligne) {
                echo "<label for='question" . $index . "'>" . $ligne["LibelleQuestion"] . "</label>";
                switch ($ligne["Type"]) {
                    case "QOuverte":
                        echo "<input type='text' class='form-control' id='question" . $index . "'>";
                        break;
                    case "QRU":
                        echo "<div class='form-group'>";
                        echo "<select class='form-control' id='question" . $index . "'>";
                        $answers = get_quizz_answers($ligne["NumQuestion"]);
                        echo "<option value='-1'>Sélectionner une réponse</option>";
                        foreach ($answers as $answer) {
                            echo "<option value='" . $answer["NumReponse"] . "'>" . $answer["Libelle"] . "</option>";
                        }
                        echo "</select></div>";
                        break;
                    case "QRM":
                        $answers = get_quizz_answers($ligne["NumQuestion"]);
                        $index_answer = 1;
                        foreach ($answers as $answer) {
                            $html_id_answer = "question" . $index . "_Reponse" . $index_answer;
                            echo "<div class='form-check'>";
                            echo "<input class='form-check-input' type='checkbox' value='" . $answer["NumReponse"] . "' id='" . $html_id_answer . "'>
                            <label class='form-check-label' for='" . $html_id_answer . "'>" . $answer["Libelle"] . "</label>";
                            echo "</div>";
                            $index_answer++;
                        }

                        break;
                }
                $index++;
                echo "<br/>";
            }
        }
        ?>
        <!-- 

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
    </form> -->

</body>

</html>