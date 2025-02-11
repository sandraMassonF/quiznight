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
    private array $quizSelect;

    public function __construct(int $numQuiz)
    {
        global $bdd;
        $this->bdd = $bdd;

        $this->numQuiz = $numQuiz;
        $this->quizSelect = [];
    }

    public function get_numQuiz(): int
    {
        return $this->numQuiz;
    }

    // récupère les données du quiz demandées

    public function get_quizSelect()
    {
        $idQuiz = $this->get_numQuiz();

        $quizStmt = $this->bdd->prepare("
        SELECT quiz.titre, quiz.id, 
        question.question, question.id_quiz,
        reponse.reponse, reponse.resultat, reponse.id_question
        FROM quiz
        JOIN question ON quiz.id = question.id_quiz
        JOIN reponse ON reponse.id_question = question.id
        WHERE quiz.id = :idQuiz
        ORDER BY RAND();
        ");
        $quizStmt->execute([
            ':idQuiz' => $idQuiz
        ]);
        $quizRecup = $quizStmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($quizRecup as $value) {
            $quizNom = $value['titre'];
            $quizQuestion = $value['question'];
            $quizAnswer = $value['reponse'];
            $quizResult = $value['resultat'];

            if (!isset($this->quizSelect[$quizNom])) {
                $this->quizSelect[$quizNom] = [];
            }

            if (!isset($this->quizSelect[$quizNom][$quizQuestion])) {
                $this->quizSelect[$quizNom][$quizQuestion] = [];
            }

            $this->quizSelect[$quizNom][$quizQuestion][] = [
                'answer' => $quizAnswer,
                'result' => $quizResult
            ];
        }

        return $this->quizSelect;
    }
}

$newQuiz = new Quiz(1);
$quizSelect = $newQuiz->get_quizSelect();

// // var_dump($quizSelect);

// echo "<br><br><br>";

// foreach ($quizSelect as $quizTitle => $quizQuestions) {
//     echo $quizTitle . "<br><br><br><br>";

//     foreach ($quizQuestions as $question => $reponses) {
//         echo "<br>" . $question . "<br><br>";

//         foreach ($reponses as $key => $id_rep) {
//             echo $key . $id_rep['answer'] . "<br>";
//         }
//     }
// }
