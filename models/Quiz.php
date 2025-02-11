<?php

$host = "localhost";
$username = "root";
$password = "";

// CONNEXION à la base de donnée
try {
    $bdd  = new PDO("mysql:host=$host;dbname=s-quiz_game;charset=utf8", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}


class Quiz
{
    private $bdd;

    private int $numQuiz;
    private array $listRaw;
    private array $quiz;
    private array $questions;
    private array $answers;

    public function __construct(int $numQuiz)
    {
        global $bdd;
        $this->bdd = $bdd;

        $this->numQuiz = $numQuiz;
        $this->listRaw = [];
        $this->quiz = [];
        $this->questions = [];
        $this->answers = [];
    }

    public function get_numQuiz(): int
    {
        return $this->numQuiz;
    }

    public function get_rawList(): array
    {
        $idQuiz = $this->get_numQuiz();

        $listRawStmt = $this->bdd->prepare("
        SELECT quiz.titre, quiz.id, 
        question.question, question.id_quiz,
        reponse.reponse, reponse.resultat, reponse.id_question
        FROM quiz
        JOIN question ON quiz.id = question.id_quiz
        JOIN reponse ON reponse.id_question = question.id
        WHERE quiz.id = $idQuiz;
        ");
        $listRawStmt->execute();
        $this->listRaw = $listRawStmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->listRaw;
    }

    public function get_quizNom()
    {

        $quizInfos = $this->get_rawList();

        foreach ($quizInfos as $value) {
            $quizId = $value['id'];
            $quizNom = $value['titre'];
            $quizQuestion = $value['question'];
            $quizAnswer = $value['reponse'];
            $quizResult = $value['resultat'];


            $this->quiz[$quizId] = [
                'titre' => $quizNom,
                'questions' => []
            ];

            foreach ($value['question'] as $value) {

                $this->quiz[$quizId]['questions'] = $value;
            }

            return $this->quiz;
        }
    }
}

$newQuiz = new Quiz(1);
var_dump($newQuiz->get_rawList());
// var_dump($newQuiz->get_quizQuestionsAnswers());
// var_dump($newQuiz->get_quizQuestionsAnswers());
// var_dump($newQuiz->get_quizQuestionsAnswers());
var_dump($newQuiz->get_quizNom());
