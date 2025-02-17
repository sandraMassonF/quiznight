<?php
session_start();
include("../models/Question.php");
include("../models/Response.php");
// Ajout de la nouvelle question
if ((isset($_POST['valid-question'])) and ($_POST['question'] != "")) {
    $question = htmlspecialchars($_POST['question']);
    $id_quiz = $_SESSION['quizId'];
    $newQuestion = new Question();
    $newQuestion->createQuestion($question, $id_quiz);
    $lastQuestion = $newQuestion->getLastQuestion();
    $_SESSION['last-question'] = $lastQuestion[0]['question'];
    $_SESSION['last-question-id'] = $lastQuestion[0]['id'];
};
// Ajout des reponse à la question
if ((isset($_POST['valid-response'])) and (($_POST['good'] == "") || ($_POST['bad1'] == "") || ($_POST['bad2'] == "") || ($_POST['bad3'] == ""))) {
    $error = new Question();
    $error->deleteQuestion($_SESSION['last-question-id']);
    unset($_SESSION['last-question']);
    unset($_SESSION['last-question-id']);
    header("location: ./autor-modif-quiz.php");
} elseif ((isset($_POST['valid-response'])) and (($_POST['good'] != "") || ($_POST['bad1'] != "") || ($_POST['bad2'] != "") || ($_POST['bad3'] != ""))) {
    $goodResponse = htmlspecialchars($_POST['good']);
    $response1 = htmlspecialchars($_POST['bad1']);
    $response2 = htmlspecialchars($_POST['bad2']);
    $response3 = htmlspecialchars($_POST['bad3']);
    $id_question = $_SESSION['last-question-id'];
    $newResponse = new Response();
    $newResponse->createResponse($goodResponse, 1, $id_question);
    $newResponse->createResponse($response1, 0, $id_question);
    $newResponse->createResponse($response2, 0, $id_question);
    $newResponse->createResponse($response3, 0, $id_question);
    unset($_SESSION['last-question']);
    unset($_SESSION['last-question-quiz']);
    header("location: ./autor-modif-quiz.php");
};

?><?php include '../component/header.php'; ?>

<main class="autor-quiz">

    <h1 class="title-quiz">Quiz : BLABLABLA</h1>
    <section class="new-question-update">
        <article class="new-question-update-card">
            <form action="" method="post">
                <div class="valid-question">
                    <?php if (isset($_SESSION['last-question'])) : ?>
                        <h3 class="last-question"><?= $_SESSION['last-question'] ?></h3>
                    <?php else : ?>
                        <input type="text" class="new-question-update-input new-question" placeholder="Posez votre question" name="question">
                        <label for="valid-question">Veuillez valider la question</label>
                        <input type="submit" name="valid-question" id="valid-question" class="button valider button-center" value="Valider">
                    <?php endif ?>
                </div>
            </form>
            <form action="" method="post">
                <?php if ((isset($_POST['valid-question'])) and ($_POST['question'] === "")) : ?>
                    <p class="error-question">Veuillez Entrer une question !</p>
                <?php elseif ((isset($_POST['valid-question'])) and ($_POST['question'] != "")) : ?>
                    <ul class="new-question-update-list">
                        <input type="text" class="new-question-update-input new-answer" placeholder="Entrez la BONNE réponse" name="good"></input>
                        <input type="text" class="new-question-update-input new-answer" placeholder="Entrez 1er mauvaise réponse" name="bad1"></input>
                        <input type="text" class="new-question-update-input new-answer" placeholder="Entrez 2eme mauvaise réponse" name="bad2"></input>
                        <input type="text" class="new-question-update-input new-answer" placeholder="Entrez 3eme mauvaise réponse" name="bad3"></input>
                    </ul>
                    <input type="submit" name="valid-response" id="button" class="button valider button-center" value="Valider">
                <?php endif ?>
            </form>
        </article>
    </section>

</main>
<?php include '../component/footer.php'; ?>