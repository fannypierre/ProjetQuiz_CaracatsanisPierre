<?php 
session_start();
if(isset($_SESSION["login"])) $user = $_SESSION["login"]; 
else $user = "User";

require_once "includes/head.php";
require_once "includes/header.php";
require_once "connexionBD.php";
$quizz_id = $_GET['quiz_id'];
?>

<DOCTYPE html>

<html lang="fr">

    <body>
        <?php
            $lignes = get_quizz($quizz_id); 
            /*echo '<pre>';
            var_dump($_POST);
            echo '</pre>';*/
            $score = 0;
            if (isset($_POST['answers'])) {
                foreach ($_POST['answers'] as $question_id => $answer) {
                   $validite_answers = get_quizz_answers($question_id);
                   $question_data = get_question($question_id);
                   /*
                   echo '<br/><br/>';
                   echo '<pre>';
                   var_dump($validite_answers, $question_id, $answer);
                   echo '</pre>';
                    */
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
        <h1>Titre</h1>

        <div id="res">
            <p>Félicitations, votre score est : <?php echo $score ?></p>
            <?php
                $best_score = get_best_score($quizz_id, $user);
                if (isset($best_score)) {
                    if ($score > $best_score[0]["MeilleurScore"]) {
                        $requete = $bdd->prepare("UPDATE Score SET MeilleurScore = ? WHERE NumQuestionnaire = ?");
                        $requete->execute(array($score, $quizz_id));
                        echo "Félicitations, vous venez de battre votre record !";
                    }
                }
                else {
                    $requete = $bdd->prepare("INSERT INTO Score(Login, NumQuestionnaire, MeilleurScore) VALUE (?, ?, ?)");
                    $requete->execute(array($user, $quizz_id, $score));
                }

                //TODO : récupérer $time
                    //TODO : afficher $time
                    //echo $_POST['time'];
            ?>
            <p>Vous pouvez <a href="questions.php">refaire ce quiz</a> ou <a href="accueilQuiz.php">retourner à la page d'accueil</a></p>
        </div>
    </body>
</html>