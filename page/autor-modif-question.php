<?php
session_start();
include_once("../models/Question.php");
include_once("../models/Response.php");
$question = new Question();
$updateTheQuestion = $question->getQuestionById($_SESSION['questionId']);
$question = array_keys($updateTheQuestion)[0];

if (isset($_POST['update'])) {
    $updateQuestion = new Question();
    $updateQuestion->updateQuestion($_SESSION['questionId'], $_POST['question']);
    $goodResponse = htmlspecialchars($_POST['good']);
    $response1 = htmlspecialchars($_POST['bad1']);
    $response2 = htmlspecialchars($_POST['bad2']);
    $response3 = htmlspecialchars($_POST['bad3']);
    $id_question = $_SESSION['questionId'];
    $newResponse = new Response();
    $newResponse->updateResponse($updateTheQuestion[$question][0]['reponseId'], $goodResponse, 1, $id_question);
    $newResponse->updateResponse($updateTheQuestion[$question][1]['reponseId'], $response1, 0, $id_question);
    $newResponse->updateResponse($updateTheQuestion[$question][2]['reponseId'], $response2, 0, $id_question);
    $newResponse->updateResponse($updateTheQuestion[$question][3]['reponseId'], $response3, 0, $id_question);
    header("location: ./autor-modif-quiz.php");
};
?>

<?php include '../component/header.php'; ?>
<main class="autor-quiz">
    <h1 class="title-quiz">Quiz : BLABLABLA</h1>
    <section class="new-question-update">
        <h2 class="update-question">Vous pouvez modifier les valeurs de la question et/ou des réponses !</h2>
        <article class="new-question-update-card">
            <form action="" method="post">
                <input type="text" class="new-question-update-input new-question" value="<?= $question ?>" name="question">
                <ul class="new-question-update-list">
                    <input type="text" class="new-question-update-input new-answer" value="<?= $updateTheQuestion[$question][0]['answer'] ?>" name="good">
                    <input type="text" class="new-question-update-input new-answer" value="<?= $updateTheQuestion[$question][1]['answer'] ?>" name="bad1">
                    <input type="text" class="new-question-update-input new-answer" value="<?= $updateTheQuestion[$question][2]['answer'] ?>" name="bad2">
                    <input type="text" class="new-question-update-input new-answer" value="<?= $updateTheQuestion[$question][3]['answer'] ?>" name="bad3">
                </ul>
                <div class="question-update-action">
                    <input type="submit" name="update" id="button" class="button valider button-center" value="Modifier">
                </div>
            </form>
        </article>
    </section>
</main>
<?php include '../component/footer.php'; ?>