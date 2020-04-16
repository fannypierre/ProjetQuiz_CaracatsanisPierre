<?php
//Connexion à la bd
$bdd = null;

// $servername = "localhost";
// $username = "id12709408_caracatsanispierre";
// $password = "Azerty12345!";
// $database = "id12709408_quizprojet";

// try {
//     $bdd = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
//     $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     echo 'Connexion échouée : ' . $e->getMessage();
// }

try {
    $bdd = new PDO("mysql:host=localhost;dbname=id12709408_quizprojet", "root", "root");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}

//Fonction permettant de récupérer tous les renseignements des questionnaires de la bd
function get_questionnaires()
{
    global $bdd;
    if (isset($bdd)) {
        $query = $bdd->query("SELECT * FROM Questionnaire");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    return null;
}

//Fonction permettant de récupérer le titre (thème) du questionnaire dont l'identifiant correspond à celui passé en paramètre (obtenu avec GET)
function get_quizz_theme($id)
{
    global $bdd;
    $sql = "SELECT Theme
    FROM Questionnaire
    WHERE NumQuestionnaire = :id";
    $query = $bdd->prepare($sql);
    $result = $query->execute(array(':id' => $id));
    return $result ? $query->fetch() : null;
}

//Fonction permettant de récupérer le type d'affichage du questionnaire dont l'identifiant correspond à celui passé en paramètre
function get_quizz_affichage($id)
{
    global $bdd;
    $sql = "SELECT TypeAffichage
    FROM Questionnaire
    WHERE NumQuestionnaire = :id";
    $query = $bdd->prepare($sql);
    $result = $query->execute(array(':id' => $id));
    return $result ? $query->fetch() : null;
}

//Fonction permettant de récupérer les questions du questionnaire dont l'identifiant correspond à celui passé en paramètre
function get_quizz($id)
{
    global $bdd;
    $sql = "SELECT Q.NumQuestion, Q.LibelleQuestion, Q.Type
    FROM Question AS Q, Associationqq AS AQQ
    WHERE AQQ.NumQuestionnaire = :id
    AND AQQ.NumQuestion = Q.NumQuestion";
    $query = $bdd->prepare($sql);
    $result = $query->execute(array(':id' => $id));
    return $result ? $query->fetchAll() : null;
}

//Fonction permettant de récupérer les réponses correspondant à la question dont l'identifiant est passé en paramètre
function get_quizz_answers($id_question)
{
    global $bdd;
    $sql = "SELECT R.NumReponse, R.Libelle, R.ValiditeReponse
    FROM Reponse AS R, Associationqr AS AQR
    WHERE AQR.NumQuestion = :id AND AQR.NumReponse = R.NumReponse";
    $query = $bdd->prepare($sql);
    $result = $query->execute(array(':id' => $id_question));
    return $result ? $query->fetchAll(PDO::FETCH_ASSOC) : null;
}

//Fonction permettant de récupérer les informations d'une question dont l'identifiant correspond à celui passé en paramètre
function get_question($id_question){
    global $bdd;
    $sql = "SELECT *
    FROM Question where NumQuestion = :id";
    $query = $bdd->prepare($sql);
    $result = $query->execute(array(':id' => $id_question));
    return $result ? $query->fetchAll(PDO::FETCH_ASSOC)[0] : null;
}

//Fonction permettant de récupérer le meilleur score et le meilleur temps d'un utilisateur sur un quiz (passés en paramètre)
function get_best_score($id, $id_user) {
    global $bdd;
    $sql = "SELECT MeilleurScore, MeilleurTemps
    FROM Score WHERE Login = :id_user AND NumQuestionnaire = :id";
    $query = $bdd->prepare($sql);
    $result = $query->execute(array(':id' => $id, ':id_user' => $id_user));
    return $result ? $query->fetchAll() : null;
}
