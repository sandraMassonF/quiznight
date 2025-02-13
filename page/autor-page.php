<?php
session_start();
include('../models/Quiz.php');
if (isset($_POST['view'])) {
    $_SESSION['quizId'] = array_keys($_POST)[0];
    echo $_SESSION['quizId'];
    header("location: ./autor-modif-quiz.php");
};
if (isset($_POST['new-quiz'])) {
    header("location: ./autor-new-quiz.php");
};

$quiz = new Quiz();
$result = $quiz->getQuizUser($_SESSION['user']);
var_dump($_SESSION);

?>

<?php include '../component/header.php'; ?>
<main class="autor-page">

    <h1 class="autor-title">Bienvenu $user !</h1>
    <form action="" method="post">
        <input type="submit" name="new-quiz" id="button" class="button-new valider" value="Nouveau Quiz +">
    </form>

    <section class="quiz">

        <?php foreach ($result as $quiz): ?>
            <article class="quiz-card">
                <h2 class="quiz-card-title"><?= $quiz['titre'] ?></h2>
                <div class="quiz-card-img">
                    <img src="../asset/img/sonGoku.jpg" alt="san goku et les boules de cristal">
                </div>
                <p class="quiz-card-description"><?= $quiz['description'] ?></p>
                <form action="" method="post">
                    <input type="hidden" name="<?= $quiz['id'] ?>" value=<?= $quiz['id'] ?>>
                    <input type="submit" name="view" id="button" class="button valider button-center" value="Afficher">
                </form>
            </article>
        <?php endforeach ?>
    </section>



</main>
<?php include '../component/footer.php'; ?>