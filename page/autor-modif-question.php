<?php
session_start();
include_once("../models/Question.php");
include_once("../models/Response.php");
var_dump($_SESSION);
$question = new Question();
$updateQuestion = $question->getQuestionById($_SESSION['questionId']);

if (isset($_POST['update'])) {
    var_dump($_POST);
    // header("location: ./autor-modif-quiz.php");
};
?>


<?php include '../component/header.php'; ?>
<main class="autor-quiz">

    <h1 class="title-quiz">Quiz : BLABLABLA</h1>
    <section class="new-question-update">
        <article class="new-question-update-card">
            <input type="text" class="new-question-update-input new-question" placeholder="La question à modifier"></input>
            <ul class="new-question-update-list">
                <input type="text" class="new-question-update-input new-answer" placeholder="La reponse à modifier"></input>
                <input type="text" class="new-question-update-input new-answer" placeholder="La reponse à modifier"></input>
                <input type="text" class="new-question-update-input new-answer" placeholder="La reponse à modifier"></input>
                <input type="text" class="new-question-update-input new-answer" placeholder="La reponse à modifier"></input>
            </ul>
            <div class="question-update-action">
                <form action="" method="post">
                    <input type="submit" name="update" id="button" class="button valider button-center" value="Modifier">
                </form>
            </div>
        </article>
    </section>

</main>
<?php include '../component/footer.php'; ?>