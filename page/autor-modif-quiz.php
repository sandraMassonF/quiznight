<?php
session_start();
include("../models/Quiz.php");
$q = 0;
// les redirections
if (isset($_POST['update'])) {
    header("location: ./autor-modif-question.php");
};
if (isset($_POST['new-question'])) {
    header("location: ./autor-new-question.php");
};
if (isset($_POST['return'])) {
    header("location: ./autor-page.php");
};

// Modification du titre d'un Quiz
if (isset($_POST['update-new-name'])) {
    $titre = htmlspecialchars($_POST['new-name']);
    $id = htmlspecialchars($_SESSION['quizId']);
    $quizUpdate = new Quiz();
    $quizUpdate->updateNameQuiz($id, $titre);
};
$quizSelect = new Quiz();
$result = $quizSelect->get_quizSelect($_SESSION['quizId']);
$resultQuiz = $quizSelect->getOneQuiz($_SESSION['quizId']);

// Suppression d'un Quiz
if (isset($_POST['delete-quiz'])) {
    $deleteQuiz = new Quiz();
    $deleteQuiz->deleteQuiz($_SESSION['quizId']);
    header("location: ./autor-page.php");
}
?>

<?php include '../component/header.php'; ?>
<main class="autor-quiz">
    <div class="update-quiz">
        <?php if (isset($_POST['update-name'])) : ?>
            <form action="" method="post" class="form-update-name">
                <div class="form-new-name">
                    <input type="text" name="new-name" class="new-name" placeholder="<?= $resultQuiz[0]['titre'] ?>" value="<?= $resultQuiz[0]['titre'] ?>">
                    <input type="submit" name="update-new-name" id="button" class="button valider button-center" value="valider">
                </div>
            </form>
        <?php else : ?>
            <h1 class="title-quiz">Quiz : <?= $resultQuiz[0]['titre'] ?></h1>
            <form action="" method="post">
                <input type="submit" name="update-name" id="button" class="button valider" value="Modifier">
            </form>
            <form action="" method="post">
                <input type="submit" name="delete-quiz" id="button" class="button delete" value="supprimer">
            </form>
        <?php endif ?>
    </div>
    <form action="" method="post">
        <input type="submit" name="new-question" id="button" class="button-new valider" value="Nouvelle Question">
    </form>
    <section class="question">
        <?php foreach ($result as $questions) : ?>
            <?php foreach ($questions as $question) : ?>
                <article class="question-card">
                    <h2 class="question-card-title"><?= array_keys($questions)[$q] ?></h2>
                    <ul>
                        <?php foreach ($question as $response): ?>
                            <li class="question-answer"><?= $response['answer'] ?></li>
                        <?php endforeach ?>
                    </ul>
                    <div class="question-action">
                        <form action="" method="post">
                            <input type="submit" name="update" id="button" class="button valider button-center" value="Modifier">
                        </form>
                        <form action="" method="post">
                            <input type="submit" name="delete" id="button" class="button delete button-center" value="Supprimer">
                        </form>
                    </div>
                </article>
            <?php $q += 1;
            endforeach ?>
        <?php endforeach ?>
    </section>
    <form action="" method="post">
        <input type="submit" name="return" id="button" class="button-new valider" value="Retour aux Quiz">
    </form>
</main>
<?php include '../component/footer.php'; ?>