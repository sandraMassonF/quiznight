<?php
include(__DIR__ . "/Class.Bdd.php");

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
        $newBdd = new ConnexionBdd();
        $bdd = $newBdd->connexion();
        $quizStmt = $bdd->prepare("
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
                $_SESSION['rightAnswer']++;
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
        $newBdd = new ConnexionBdd();
        $bdd = $newBdd->Connexion();
        $sql = "SELECT * FROM quiz";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Récupération des quiz d'UN utilisateur
    public function getQuizUser($id)
    {
        $newBdd = new ConnexionBdd();
        $bdd = $newBdd->connexion();
        $sql = "SELECT * FROM quiz WHERE id_user = $id";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupération d'un quiz via son id
    public function getOneQuiz($quizId)
    {
        $newBdd = new ConnexionBdd();
        $bdd = $newBdd->connexion();
        $sql = "SELECT *
        FROM quiz
        WHERE quiz.id = $quizId ";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllQuizByUser()
    {
        $newBdd = new ConnexionBdd();
        $bdd = $newBdd->Connexion();
        $sql = "SELECT quiz.id, quiz.titre, quiz.description, quiz.id_user, utilisateur.pseudo FROM quiz JOIN utilisateur ON quiz.id_user = utilisateur.id ORDER BY quiz.id;";

        $stmt = $bdd->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //update du nom du quiz
    public function updateNameQuiz($id, $titre)
    {
        $newBdd = new ConnexionBdd();
        $bdd = $newBdd->connexion();
        $sql = "UPDATE quiz SET titre = :titre WHERE id = :id";
        $update = $bdd->prepare($sql);
        $update->execute([
            ':titre' => $titre,
            ':id' => $id
        ]);
    }

    //création nouveau quiz
    public function createQuiz($titre, $description, $id_user)
    {
        $newBdd = new ConnexionBdd();
        $bdd = $newBdd->connexion();
        $sql = "INSERT INTO quiz (titre, description, id_user) VALUES (:titre, :description, :id_user)";
        $create = $bdd->prepare($sql);
        $create->execute([
            ':titre' => $titre,
            ':description' => $description,
            ':id_user' => $id_user
        ]);
    }

    // Supprimer un Quiz
    public function deleteQuiz($quizId)
    {
        $newBdd = new ConnexionBdd();
        $bdd = $newBdd->connexion();
        $sql = "DELETE FROM quiz WHERE id= $quizId";
        $delete = $bdd->prepare($sql);
        $delete->execute();
    }

    // récupérer le dernier quiz créer
    public function getLastQuiz()
    {
        $newBdd = new ConnexionBdd();
        $bdd = $newBdd->connexion();
        $sql = "SELECT id, titre, description
    FROM quiz
    ORDER BY id DESC
    LIMIT 1";
        $selectLast = $bdd->prepare($sql);
        $selectLast->execute();
        return $selectLast->fetchAll(PDO::FETCH_ASSOC);
    }
}
