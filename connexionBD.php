<?php
$bdd = null;
try {
    $bdd = new PDO("mysql:host=localhost;dbname=id12709408_quizprojet", "root", "root");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}

function get_questionnaires()
{
    global $bdd;
    if (isset($bdd)) {
        $query = $bdd->query("SELECT * FROM Questionnaire");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    return null;
}

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

function get_quizz_answers($id_question)
{
    global $bdd;
    $sql = "SELECT R.NumReponse, R.Libelle, R.ValiditeReponse
    FROM Reponse AS R, Associationqr AS AQR
    WHERE AQR.NumQuestion = :id AND AQR.NumReponse = R.NumReponse";
    $query = $bdd->prepare($sql);
    $result = $query->execute(array(':id' => $id_question));
    return $result ? $query->fetchAll() : null;
}