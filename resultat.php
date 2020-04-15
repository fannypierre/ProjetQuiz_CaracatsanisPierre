<?php 
session_start();
if (isset($_SESSION["email"])) {
    $user = $_SESSION["email"];
} else {
    $user = "user";
}

require_once "includes/head.php";
require_once "includes/header.php";
require_once "connexionBD.php";
$quizz_id = $_GET['quiz_id'];
?>

<DOCTYPE html>

<html lang="fr">

    <body>
        <?php
            $timer_end = time();
            $time = $timer_end - $_COOKIE['timer'];

            $lignes = get_quizz($quizz_id); 
            $score = 0;
            if (isset($_POST['answers'])) {
                foreach ($_POST['answers'] as $question_id => $answer) {
                   $validite_answers = get_quizz_answers($question_id);
                   $question_data = get_question($question_id);
                   switch($question_data['Type']){
                        case "QRU":
                            foreach($validite_answers as $possible_answer){
                                if($possible_answer['ValiditeReponse'] == '1'){
                                    if($possible_answer['NumReponse'] == $answer){
                                        $score += 1;
                                    }
                                }
                            }
                        break;
                        case "QOuverte":
                            foreach($validite_answers as $possible_answer){
                                if($possible_answer['ValiditeReponse'] == '1'){
                                    if($possible_answer['Libelle'] == $answer){
                                        $score += 1;
                                    }
                                }
                            }
                        break;
                        case "QRM":
                            foreach($validite_answers as $possible_answer){
                                if($possible_answer['ValiditeReponse'] == '1'){
                                    if(in_array($possible_answer['NumReponse'], $answer, false)){
                                        $score += 1;
                                    }
                                }
                            }
                        break;
                   }
                    
                }
            }                
        ?>
        <?php
            $theme = get_quizz_theme($quizz_id)["Theme"];
            if (isset($theme)) {
                echo "<h1>".$theme."</h1>";
            }
        ?>

        

        <div id="res">
            <?php
                echo "<p>Félicitations, vous avez atteint un total de ".$score." points en ".$time." secondes !</p>";
                $best_score = get_best_score($quizz_id, $user);
                if (isset($best_score) && count($best_score)>0) {
                    if ($score > $best_score[0]["MeilleurScore"]) {
                        $requete = $bdd->prepare("UPDATE Score SET MeilleurScore = ? WHERE NumQuestionnaire = ? AND Login = ?");
                        $requete->execute(array($score, $quizz_id, $user));
                        echo "Félicitations, vous venez de battre votre record de bonnes réponses !";
                    }

                    if ($time < $best_score[0]["MeilleurTemps"]) {
                        $requete = $bdd->prepare("UPDATE Score SET MeilleurTemps = ? WHERE NumQuestionnaire = ? AND Login = ?");
                        $requete->execute(array($time, $quizz_id, $user));
                        echo "Félicitations, vous venez de battre votre chronomètre!";
                    }
                }
                else {
                    $requete = $bdd->prepare("INSERT INTO Score(Login, NumQuestionnaire, MeilleurScore, MeilleurTemps) VALUE (?, ?, ?, ?)");
                    $requete->execute(array($user, $quizz_id, $score, $time));
                }
               echo "<p>Vous pouvez <a href='#choixDifficulte'>refaire ce quiz</a> ou <a href='accueilQuiz.php'>retourner à la page d'accueil</a></p>";
            
               echo '<div class="login" id="choixDifficulte">
               <div class="popup-inner">
                   <img src="images/Logo.svg" width="20%" class="d-inline-block align-top" alt="">
                   <h2>QUIZZZ</h2>
                   <form id="difficulte-form" role="form" action="questions.php?quiz_id='.$quizz_id. '" method="post">
                       <div>
                           <input type="radio" id="facile" name="difficulte" value="facile" checked>
                           <label for="facile">Facile</label>
                       </div>
                       <div>
                           <input type="radio" id="moyen" name="difficulte" value="moyen">
                           <label for="moyen">Moyen</label>
                       </div>
                       <div>
                           <input type="radio" id="difficile" name="difficulte" value="difficile">
                           <label for="difficile">Difficile</label>
                       </div>
                       </br>
                       <button type="submit" class="btn btn-light" width="50%">Valider</button>
                   </form>
                   <a id ="bouton-closepopup" class="closepopup" href="">X</a>
               </div>
           </div>';            
            ?>
        </div>
    </body>
</html>