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
            //Calcul du temps : récupération du temps actuel et de celui contenu dans le cookie et soustraction
            $timer_end = time();
            $time = $timer_end - $_COOKIE['timer'];

            //Traitement des bonnes réponses
            $lignes = get_quizz($quizz_id); 
            //Initialisation du score
            $score = 0;
            //Récupération des réponses
            if (isset($_POST['answers'])) {
                foreach ($_POST['answers'] as $question_id => $answer) {
                   $validite_answers = get_quizz_answers($question_id);
                   $question_data = get_question($question_id);
                   //Test de la validé des bonnes réponses en fonction du type de la réponse
                   switch($question_data['Type']){
                        case "QRU":
                            foreach($validite_answers as $possible_answer){
                                if($possible_answer['ValiditeReponse'] == '1'){
                                    if($possible_answer['NumReponse'] == $answer){
                                        //Le score prend +1 si la validité de la réponse est = 1 autrement dit si la réponse est valide
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
            //Affichage du titre de la page en fonction du titre du questionnaire correspondant à l'id du questionnaire passé en GET (page accueil)
            $theme = get_quizz_theme($quizz_id)["Theme"];
            if (isset($theme)) {
                echo "<h1>".$theme."</h1>";
            }
        ?>

        

        <div id="res">
            <?php
                //Affichage du score
                echo "<p>Félicitations, vous avez atteint un total de ".$score." points en ".$time." secondes !</p>";
                //Stockage dans la bd du meilleur score et du meilleur temps
                $best_score = get_best_score($quizz_id, $user);
                //Si le joueur a déjà joué au questionnaire
                if (isset($best_score) && count($best_score)>0) {

                    //Enregistrement du score s'il a fait un meilleur score
                    if ($score > $best_score[0]["MeilleurScore"]) {
                        $requete = $bdd->prepare("UPDATE Score SET MeilleurScore = ? WHERE NumQuestionnaire = ? AND Login = ?");
                        $requete->execute(array($score, $quizz_id, $user));
                        echo "Félicitations, vous venez de battre votre record de bonnes réponses !";
                    }
                    
                    //Enregistrement du temps s'il a fait un meilleur temps
                    if ($time < $best_score[0]["MeilleurTemps"]) {
                        $requete = $bdd->prepare("UPDATE Score SET MeilleurTemps = ? WHERE NumQuestionnaire = ? AND Login = ?");
                        $requete->execute(array($time, $quizz_id, $user));
                        echo "Félicitations, vous venez de battre votre chronomètre!";
                    }
                }
                //Enregistrement du score et du temps si le joueur n'a jamais joué au quiz
                else {
                    $requete = $bdd->prepare("INSERT INTO Score(Login, NumQuestionnaire, MeilleurScore, MeilleurTemps) VALUE (?, ?, ?, ?)");
                    $requete->execute(array($user, $quizz_id, $score, $time));
                }

                //Liens pour rejouer le quiz (pop-up permettant de choisir la difficulté) ou revenir à la page d'accueil
                echo "<p>Vous pouvez <a href='#choixDifficulte'>refaire ce quiz</a> ou <a href='accueilQuiz.php'>retourner à la page d'accueil</a></p>";
                
                //Pop-up pour chosisir la difficulté si le joueur veut rejouer
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