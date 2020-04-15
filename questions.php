<?php
session_start();
if (isset($_SESSION["login"])) $user = $_SESSION["login"];
else $user = "User";

require_once "includes/head.php";
require_once "includes/header.php";
require_once "connexionBD.php";
$quizz_id = $_GET['quiz_id'];
?>

<?php
$cookie_name = "timer";
$cookie_value = time();
setcookie($cookie_name, $cookie_value, time() + 86400, "/");
?>

<!DOCTYPE html>

<html lang="fr">

<body>

    <?php
    $theme = get_quizz_theme($quizz_id)["Theme"];
    if (isset($theme)) {
        echo "<h1>".$theme."</h1>";
    }
    ?>

    <?php
    $affichage = get_quizz_affichage($quizz_id)["TypeAffichage"];
    echo '<form id="questionnaire" action="resultat.php?quiz_id='.$quizz_id.'" method="post">';
    
    if ($affichage=="continu") {
        $lignes = get_quizz($quizz_id);
        if (isset($lignes)) {
            $index = 1;
            foreach ($lignes as $ligne) {
                if($_POST['difficulte'] == "facile") {
                    if ($ligne["Type"] == "QRU") {
                        echo "<label for='question" . $index . "'>" . $ligne["LibelleQuestion"] . "</label>";
                        echo "<div class='form-group'>";
                        echo "<select class='form-control' name='answers[".$ligne['NumQuestion']."]' id='question" . $index . "'>";
                        $answers = get_quizz_answers($ligne["NumQuestion"]);
                        echo "<option value='-1'>Sélectionner une réponse</option>";
                        foreach ($answers as $answer) {
                            echo "<option value='" . $answer["NumReponse"] . "'>" . $answer["Libelle"] . "</option>";
                        }
                        echo "</select></div>";
                    }
                }
                elseif ($_POST['difficulte'] == "moyen") {
                    if ($ligne["Type"] == "QRU" || $ligne["Type"] == "QRM") {
                        echo "<label for='question" . $index . "'>" . $ligne["LibelleQuestion"] . "</label>";
                        switch ($ligne["Type"]) {
                            case "QRU":
                                echo "<div class='form-group'>";
                                echo "<select class='form-control' name='answers[".$ligne['NumQuestion']."]' id='question" . $index . "'>";
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
                                    echo "<input name='answers[".$ligne['NumQuestion']."][]' class='form-check-input' type='checkbox' value='" . $answer["NumReponse"] . "' id='" . $html_id_answer . "'>
                                    <label class='form-check-label' for='" . $html_id_answer . "'>" . $answer["Libelle"] . "</label>";
                                    echo "</div>";
                                    $index_answer++;
                                }
        
                            break;
                        }
                    }
                }
                else {
                    echo "<label for='question" . $index . "'>" . $ligne["LibelleQuestion"] . "</label>";
                    switch ($ligne["Type"]) {
                        case "QOuverte":
                            echo "<input type='text' name='answers[".$ligne['NumQuestion']."]' class='form-control' id='question" . $index . "'>";
                        break;
                        case "QRU":
                            echo "<div class='form-group'>";
                            echo "<select class='form-control' name='answers[".$ligne['NumQuestion']."]' id='question" . $index . "'>";
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
                                echo "<input name='answers[".$ligne['NumQuestion']."][]' class='form-check-input' type='checkbox' value='" . $answer["NumReponse"] . "' id='" . $html_id_answer . "'>
                                <label class='form-check-label' for='" . $html_id_answer . "'>" . $answer["Libelle"] . "</label>";
                                echo "</div>";
                                $index_answer++;
                            }
    
                        break;
                    }
                }
                
                $index++;
                echo "<br/>";
            }
        }
    }
    else {
        $lignes = get_quizz($quizz_id);
        $max_lines = count($lignes);
        if (isset($lignes)) {
            $index = 1;
            foreach ($lignes as $key => $ligne) {
                if($_POST["difficulte"] == "facile") {
                    if ($ligne["Type"] == "QRU") {
                        echo "<div id='question_".$key."' style='display: ".($key == 0 ? 'block' : 'none')."'>";
                        echo "<label for='question" . $index . "'>" . $ligne["LibelleQuestion"] . "</label>";
                        echo "<div class='form-group'>";
                        echo "<select name='answers[".$ligne['NumQuestion']."]' class='form-control' id='question" . $index . "'>";
                        $answers = get_quizz_answers($ligne["NumQuestion"]);
                        echo "<option value='-1'>Sélectionner une réponse</option>";
                        foreach ($answers as $answer) {
                            echo "<option value='" . $answer["NumReponse"] . "'>" . $answer["Libelle"] . "</option>";
                        }
                        echo "</select></div>";
                    }
                }
                elseif ($_POST["difficulte"] == "moyen") {
                    if ($ligne["Type"] == "QRU" || $ligne["Type"] == "QRM") {
                        echo "<div id='question_".$key."' style='display: ".($key == 0 ? 'block' : 'none')."'>";
                        echo "<label for='question" . $index . "'>" . $ligne["LibelleQuestion"] . "</label>";
                        switch ($ligne["Type"]) {
                            case "QRU":
                                echo "<div class='form-group'>";
                                echo "<select name='answers[".$ligne['NumQuestion']."]' class='form-control' id='question" . $index . "'>";
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
                                    echo "<input name='answers[".$ligne['NumQuestion']."][]' class='form-check-input' type='checkbox' value='" . $answer["NumReponse"] . "' id='" . $html_id_answer . "'>
                                    <label class='form-check-label' for='" . $html_id_answer . "'>" . $answer["Libelle"] . "</label>";
                                    echo "</div>";
                                    $index_answer++;
                                }
                            break;
                        }
                    }
                } 
                else {
                    echo "<div id='question_".$key."' style='display: ".($key == 0 ? 'block' : 'none')."'>";
                    echo "<label for='question" . $index . "'>" . $ligne["LibelleQuestion"] . "</label>";
                    switch ($ligne["Type"]) {
                        case "QOuverte":
                            echo "<input type='text' name='answers[".$ligne['NumQuestion']."]' class='form-control' id='question" . $index . "'>";
                        break;
                        case "QRU":
                            echo "<div class='form-group'>";
                            echo "<select name='answers[".$ligne['NumQuestion']."]' class='form-control' id='question" . $index . "'>";
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
                                echo "<input name='answers[".$ligne['NumQuestion']."][]' class='form-check-input' type='checkbox' value='" . $answer["NumReponse"] . "' id='" . $html_id_answer . "'>
                                <label class='form-check-label' for='" . $html_id_answer . "'>" . $answer["Libelle"] . "</label>";
                                echo "</div>";
                                $index_answer++;
                            }
                        break;
                    }
                }
                $index++;
                echo '<br/>';
                if(($key+1) > 1){
                    echo "<button type='button' onclick='previousQuestion()' class='btn btn-danger' style='color: white'>Precedent</button>&nbsp;&nbsp;&nbsp;";
                }
                
                if(($key+1) < $max_lines ){
                    echo "<button type='button' onclick='nextQuestion()' class='btn btn-danger' style='color: white'>Suivant</button>";
                }

                echo "</div>";
                
                
            }
        }
    }
    echo '<br/>';
    echo "<input type='submit' class='btn btn-danger' style='color: white' value='Envoyer'>";
    ?>
    </form>

<script>  

var currentQuestion = 0;
var max_question = <?php echo isset($max_lines) ? $max_lines : 0; ?>

function nextQuestion(){
    if(currentQuestion < max_question){
        currentQuestion += 1;
        var dom = document.querySelector('div[id=question_'+currentQuestion+']');
        if(dom != undefined){
            dom.style.display = 'block';
        }

        var dom = document.querySelector('div[id=question_'+(currentQuestion-1)+']');
        if(dom != undefined){
            dom.style.display = 'none';
        }
    }
}

function previousQuestion(){
    if(currentQuestion < max_question){
        currentQuestion -= 1;
        var dom = document.querySelector('div[id=question_'+currentQuestion+']');
        if(dom != undefined){
            dom.style.display = 'block';
        }

        var dom = document.querySelector('div[id=question_'+(currentQuestion+1)+']');
        if(dom != undefined){
            dom.style.display = 'none';
        }
    }
}

</script>

</body>

</html>