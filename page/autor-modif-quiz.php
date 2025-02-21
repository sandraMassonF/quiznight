<?php
require '../config.php';
session_start();
include("../models/Quiz.php");
include("../models/Question.php");
include("../models/Image.php");
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
    // mise à jour des info du quiz:
    $id = htmlspecialchars($_SESSION['quizId']);
    $titre = htmlspecialchars($_POST['new-name']);
    $description = htmlspecialchars($_POST['description']);
    $quizUpdate = new Quiz();
    $quizUpdate->updateNameQuiz($id, $titre, $description);
    // mise à jour de l'image du quiz:
    $idImage = htmlspecialchars($_SESSION['imageId']);
    if ($_SESSION['imageId'] == 'view') {
        $image = new Image();
        $newImage = $image->createImage($_FILES['image']['name'], $_FILES['image']['size'], $_FILES['image']['type'], $_FILES['image']['tmp_name'], $_SESSION['quizId']);
    } elseif ($_FILES['image']['size'] > 0) {
        $image = new Image();
        $newImage = $image->updateImage($idImage, $_FILES['image']['name'], $_FILES['image']['size'], $_FILES['image']['type'], $_FILES['image']['tmp_name'], $_SESSION['quizId']);
    }
    header("location: ./autor-page.php");
};

if (isset($_POST['update-question'])) {
    $_SESSION['questionId'] = $_POST['update-question'];
    header("location: ./autor-modif-question.php");
}
$quizSelect = new Quiz();
$result = $quizSelect->get_quizSelect($_SESSION['quizId']);
$resultQuiz = $quizSelect->getOneQuiz($_SESSION['quizId']);

// Suppression d'un Quiz
if (isset($_POST['delete-quiz'])) {
    $deleteQuiz = new Quiz();
    $deleteQuiz->deleteQuiz($_SESSION['quizId']);
    header("location: ./autor-page.php");
}
// Suppression d'une Question
if (isset($_POST['delete-question'])) {
    $idQuestion = $_POST['delete-question'];
    $deleteQuestion = new Question();
    $deleteQuestion->deleteQuestion($idQuestion);
    header("location: ./autor-modif-quiz.php");
}
?>

<?php include '../components/header.php'; ?>
<main class="autor-quiz">
    <div class="update-quiz">
        <?php if (isset($_POST['update-name'])) : ?>
            <form enctype="multipart/form-data" action="" method="post" class="form-update-name">
                <div class="form-new-name">
                    <input type="text" name="new-name" class="new-name" value="<?= $resultQuiz[0]['titre'] ?>">
                    <input type="text" name="description" class="new-name" value="<?= $resultQuiz[0]['description'] ?>">
                    <input type="file" name="image" class="new-image">
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
                            <button type="submit" class="button valider button-center" name="update-question" value="<?= $question[0]['id_question'] ?>">Modifier</button>
                        </form>
                        <form action="" method="post">
                            <button type="submit" class="button delete button-center" name="delete-question" value="<?= $question[0]['id_question'] ?>">Supprimer</button>
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
<?php include '../components/footer.php'; ?>