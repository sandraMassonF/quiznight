<?php
include_once(__DIR__ . "/Class.Bdd.php");
class Question
{

  public function createQuestion($question, $id_quiz)
  {
    $newBdd = new ConnexionBdd();
    $bdd = $newBdd->connexion();
    $sql = "INSERT INTO question (question, id_quiz) VALUES (:question, :id_quiz)";
    $create = $bdd->prepare($sql);
    $create->execute([
      ':question' => $question,
      ':id_quiz' => $id_quiz,
    ]);
  }
  public function getLastQuestion()
  {
    $newBdd = new ConnexionBdd();
    $bdd = $newBdd->connexion();
    $sql = "SELECT id, question
  FROM question
  ORDER BY id DESC
  LIMIT 1";
    $selectLast = $bdd->prepare($sql);
    $selectLast->execute();
    return $selectLast->fetchAll(PDO::FETCH_ASSOC);
  }





  public function updateQuestion($id_question, $question)
  {
    $newBdd = new ConnexionBdd();
    $bdd = $newBdd->connexion();
    $sql = "UPDATE question SET question = :question WHERE id = :id";
    $update = $bdd->prepare($sql);
    $update->execute([
      ':question' => $question,
      ':id' => $id_question
    ]);
  }
}
