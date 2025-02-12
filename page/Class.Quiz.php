<?php
include_once("./Class.Bdd.php");

class Quiz
{

    public function getAllQuiz()
    {
        $newBdd = new ConnexionBdd();
        $bdd = $newBdd->Connextion();
        $sql = "SELECT * FROM quiz";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
