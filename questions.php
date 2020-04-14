<?php
session_start();
if (isset($_SESSION["login"])) $user = $_SESSION["login"];
else $user = "User";

require_once "includes/head.php";
require_once "includes/header.php";
require_once "connexionBD.php";
$quizz_id = $_GET['quiz_id'];
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
    //TODO : niveaux de difficulté

    //Lancement timer
    $timer_start = microtime_float();
    $affichage = get_quizz_affichage($quizz_id)["TypeAffichage"];
    echo '<form id="questionnaire" action="resultat.php?quiz_id='.$quizz_id.'" method="post">';
    
    if ($affichage=="continu") {
        $lignes = get_quizz($quizz_id);
        if (isset($lignes)) {
            $index = 1;
            foreach ($lignes as $ligne) {
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
                $index++;
                echo '<br/>';
                //echo "<a href='questions.php?quiz_id=".$quizz_id."&page=".($page-1)."' class='btn btn-danger' style='color: white'>Précédent</a>&nbsp;&nbsp;&nbsp;";
                //echo "<a href='questions.php?quiz_id=".$quizz_id."&page=".($page+1)."' class='btn btn-danger' style='color: white'>Suivant</a>";
                if(($key+1) > 1){
                    echo "<button type='button' onclick='previousQuestion()' class='btn btn-danger' style='color: white'>Precedent</button>&nbsp;&nbsp;&nbsp;";
                }
                
                if(($key+1) < $max_lines ){
                    echo "<button type='button' onclick='nextQuestion()' class='btn btn-danger' style='color: white'>Suivant</button>";
                }

                echo "</div>";
                
                
            } //TODO : affichage question par question et lien entre les questions (une page différente pour chaque id de question ?)
            //TODO : dernier bouton envoyer, comment faire la différence ?
        }
    }
    echo '<br/>';
    echo "<input type='submit' class='btn btn-danger' style='color: white' value='Envoyer'>";
    
    //Fin timer (comment il arrive à savoir que c'est quand on appuie sur le bouton ?) A tester quand traitement des réponses sera fait
    $timer_end = microtime_float();
    $time = $timer_end - $timer_start;
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