<?php
include_once("Class.Bdd.php");

class Quiz
{
    public function getAllQuiz()
    {
        $newBdd = new ConnexionBdd();
        $bdd = $newBdd->Connextion(); //changer le connextion en connexion
        $sql = "SELECT * FROM quiz";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllQuizByUser()
    {
        $newBdd = new ConnexionBdd();
        $bdd = $newBdd->Connextion(); //changer le connextion en connexion
        $sql = "SELECT * FROM quiz JOIN utilisateur ON quiz.id_user = utilisateur.id ORDER BY quiz.id;";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getQuizUser($id)
    {
        $newBdd = new ConnexionBdd();
        $bdd = $newBdd->Connextion();
        $sql = "SELECT * FROM quiz WHERE id_user";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserInfo($id_user)
    {
        $newBdd = new ConnexionBdd();
        $bdd = $newBdd->Connextion(); //changer le connextion en connexion
        $sql = "SELECT * FROM utilisateur WHERE id = :id_user";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([
            ":id_user" => $id_user
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
