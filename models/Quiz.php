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

    private array $quizSelect;
    private bool $checkAnswer;

    public function __construct()
    {
        global $bdd;
        $this->bdd = $bdd;

        $this->quizSelect = [];
        $this->checkAnswer = false;
    }

    // récupère les données du quiz demandées

    public function get_quizSelect($idQuiz): array
    {

        $quizStmt = $this->bdd->prepare("
        SELECT quiz.titre, quiz.id, 
        question.question, question.id_quiz,
        reponse.reponse, reponse.resultat, reponse.id_question
        FROM quiz
        JOIN question ON quiz.id = question.id_quiz
        JOIN reponse ON reponse.id_question = question.id
        WHERE quiz.id = :idQuiz;
        ");

        // revoir ORDER BY reponse.id_question, RAND()
        // car rechange l'ordre des réponses apres submit 

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

    // vérifie la réponse

    public function get_checkAnswer($answerSubmit): bool
    {
        if (!empty($_POST)) {
            if ($answerSubmit == 1) {
                $this->checkAnswer = true;
                // return $this->checkAnswer;
            } else {
                $this->checkAnswer = false;
                // return $this->checkAnswer;
            }

            unset($_POST['answer']);
            return $this->checkAnswer;
        }
    }


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
        $sql = "SELECT quiz.id, quiz.titre, quiz.description, quiz.image, quiz.id_user, utilisateur.pseudo FROM quiz JOIN utilisateur ON quiz.id_user = utilisateur.id ORDER BY quiz.id;";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
