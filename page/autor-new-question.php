<?php
session_start();
include("../models/Question.php");
include("../models/Response.php");
// Ajout de la nouvelle question
if (isset($_POST['valid-question'])) {
    $question = htmlspecialchars($_POST['question']);
    $id_quiz = $_SESSION['quizId'];
    $newQuestion = new Question();
    $newQuestion->createQuestion($question, $id_quiz);
    $lastQuestion = $newQuestion->getLastQuestion();
    $_SESSION['last-question'] = $lastQuestion[0]['question'];
    $_SESSION['last-question-id'] = $lastQuestion[0]['id'];
    var_dump($lastQuestion);
    var_dump($_SESSION);
};
// Ajout des reponse à la question
if (isset($_POST['valid-response'])) {
    var_dump($_POST);
    var_dump($_SESSION);
    $goodResponse = htmlspecialchars($_POST['good-response']);
    $response1 = htmlspecialchars($_POST['bad-response1']);
    $response2 = htmlspecialchars($_POST['bad-response2']);
    $response3 = htmlspecialchars($_POST['bad-response3']);
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
                    <?php endif ?>
                    <?php if (!isset($_POST['valid-question'])): ?>
                        <label for="valid-question">Veuillez valider la question</label>
                        <input type="submit" name="valid-question" id="valid-question" class="button valider button-center" value="Valider">
                    <?php endif ?>
                </div>
            </form>
            <form action="" method="post">
                <ul class="new-question-update-list">
                    <input type="text" class="new-question-update-input new-answer" placeholder="Entrez la BONNE réponse" name="good-response"></input>
                    <input type="text" class="new-question-update-input new-answer" placeholder="Entrez 1er mauvaise réponse" name="bad-response1"></input>
                    <input type="text" class="new-question-update-input new-answer" placeholder="Entrez 2eme mauvaise réponse" name="bad-response2"></input>
                    <input type="text" class="new-question-update-input new-answer" placeholder="Entrez 3eme mauvaise réponse" name="bad-response3"></input>
                </ul>
                <?php if (isset($_POST['valid-question'])) : ?>
                    <input type="submit" name="valid-response" id="button" class="button valider button-center" value="Valider">
                <?php endif ?>
            </form>
        </article>
    </section>

</main>
<?php include '../component/footer.php'; ?>