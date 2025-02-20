<?php
include_once(__DIR__ . "/ConnexionBdd.php");
class Question extends ConnexionBdd
{
  public function __construct()
  {
    parent::__construct($this->bdd);
  }

  private array $questionSelect;
  // Creer une nouvelle question
  public function createQuestion($question, $id_quiz)
  {
    $sql = "INSERT INTO question (question, id_quiz) VALUES (:question, :id_quiz)";
    $create = $this->bdd->prepare($sql);
    $create->execute([
      ':question' => $question,
      ':id_quiz' => $id_quiz,
    ]);
  }

  // récupérer la dernière question créer
  public function getLastQuestion()
  {
    $sql = "SELECT id, question
    FROM question
    ORDER BY id DESC
    LIMIT 1";
    $selectLast = $this->bdd->prepare($sql);
    $selectLast->execute();
    return $selectLast->fetchAll(PDO::FETCH_ASSOC);
  }

  // Modifier une Question
  public function updateQuestion($id_question, $question)
  {
    $sql = "UPDATE question SET question = :question WHERE id = :id";
    $update = $this->bdd->prepare($sql);
    $update->execute([
      ':question' => $question,
      ':id' => $id_question
    ]);
  }

  // Supprimer un Question
  public function deleteQuestion($questionId)
  {
    $sql = "DELETE FROM question WHERE id= $questionId";
    $delete = $this->bdd->prepare($sql);
    $delete->execute();
  }

  // Récupérer une question via son Id
  public function getQuestionById($id)
  {
    $sql = "SELECT question.id, question.question, reponse.id as reponseId, reponse.reponse, reponse.resultat,reponse.id_question 
    FROM question
    JOIN reponse ON reponse.id_question = question.id
    WHERE question.id = $id";
    $selectQuestion = $this->bdd->prepare($sql);
    $selectQuestion->execute();
    $return =  $selectQuestion->fetchAll(PDO::FETCH_ASSOC);

    foreach ($return as $value) {
      $quizQuestion = $value['question'];
      $reponseId = $value['reponseId'];
      $quizAnswer = $value['reponse'];
      $quizResult = $value['resultat'];
      $quizIdQuestion = $value['id_question'];

      if (!isset($this->questionSelect[$quizQuestion])) {
        $this->questionSelect[$quizQuestion] = [];
      }

      $this->questionSelect[$quizQuestion][] = [
        'reponseId' => $reponseId,
        'answer' => $quizAnswer,
        'result' => $quizResult,
        'id_question' => $quizIdQuestion,
      ];
    };
    return $this->questionSelect;
  }
}
