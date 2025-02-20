<?php
include(__DIR__ . "/ConnexionBdd.php");

class Quiz extends ConnexionBdd
{

    private array $quizSelect;
    private bool $checkAnswer;

    public function __construct()
    {
        parent::__construct($this->bdd);

        $this->quizSelect = [];
        $this->checkAnswer = false;
    }

    // récupère les données du quiz demandées

    public function get_quizSelect($idQuiz): array
    {

        $quizStmt = $this->bdd->prepare("
        SELECT quiz.titre, quiz.id, 
        question.id as id_question, question.question, question.id_quiz,
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
            $quizIdQuestion = $value['id_question'];

            if (!isset($this->quizSelect[$quizNom])) {
                $this->quizSelect[$quizNom] = [];
            }

            if (!isset($this->quizSelect[$quizNom][$quizQuestion])) {
                $this->quizSelect[$quizNom][$quizQuestion] = [];
            }

            $this->quizSelect[$quizNom][$quizQuestion][] = [
                'answer' => $quizAnswer,
                'result' => $quizResult,
                'id_question' => $quizIdQuestion,
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
            } else {
                $_SESSION['wrongAnswer']++;
                $this->checkAnswer = false;
            }

            return $this->checkAnswer;
        }
    }

    // Récupération de TOUS les quiz
    public function getAllQuiz()
    {

        $sql = "SELECT * FROM quiz";
        $stmt = $this->bdd->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Récupération des quiz d'UN utilisateur
    public function getQuizUser($id)
    {

        $sql = "SELECT * FROM quiz WHERE id_user = $id";
        $stmt = $this->bdd->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupération d'un quiz via son id
    public function getOneQuiz($quizId)
    {

        $sql = "SELECT *
        FROM quiz
        WHERE quiz.id = $quizId ";
        $stmt = $this->bdd->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllQuizByUser()
    {

        $sql = "SELECT 
                quiz.id, 
                quiz.titre, 
                quiz.description, 
                quiz.id_user, 
                utilisateur.pseudo, 
                image.nom AS image_nom, 
                image.bin AS image_bin
            FROM quiz 
            JOIN utilisateur ON quiz.id_user = utilisateur.id
            LEFT JOIN image ON quiz.id = image.id_quiz
            ORDER BY quiz.id;";

        $stmt = $this->bdd->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //update du nom du quiz
    public function updateNameQuiz($id, $titre)
    {

        $sql = "UPDATE quiz SET titre = :titre WHERE id = :id";
        $update = $this->bdd->prepare($sql);
        $update->execute([
            ':titre' => $titre,
            ':id' => $id
        ]);
    }

    //création nouveau quiz
    public function createQuiz($titre, $description, $id_user)
    {

        $sql = "INSERT INTO quiz (titre, description, id_user) VALUES (:titre, :description, :id_user)";
        $create = $this->bdd->prepare($sql);
        $create->execute([
            ':titre' => $titre,
            ':description' => $description,
            ':id_user' => $id_user
        ]);
    }

    // Supprimer un Quiz
    public function deleteQuiz($quizId)
    {

        $sql = "DELETE FROM quiz WHERE id= $quizId";
        $delete = $this->bdd->prepare($sql);
        $delete->execute();
    }

    // récupérer le dernier quiz créer
    public function getLastQuiz()
    {

        $sql = "SELECT id, titre, description
    FROM quiz
    ORDER BY id DESC
    LIMIT 1";
        $selectLast = $this->bdd->prepare($sql);
        $selectLast->execute();
        return $selectLast->fetchAll(PDO::FETCH_ASSOC);
    }
}
