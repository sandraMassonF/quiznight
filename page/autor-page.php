<?php
session_start();
include_once('../models/Quiz.php');
include_once('../models/Image.php');
if (isset($_POST['view'])) {
    $_SESSION['quizId'] = array_keys($_POST)[0];
    $_SESSION['imageId'] = array_keys($_POST)[1];
    header("location: ./autor-modif-quiz.php");
};
if (isset($_POST['new-quiz'])) {
    header("location: ./autor-new-quiz.php");
};

$quiz = new Quiz();
$result = $quiz->getQuizUser($_SESSION['user']);
?>

<?php include '../component/header.php'; ?>
<main class="autor-page">

    <h1 class="autor-title">Bienvenu $user !</h1>
    <form action="" method="post">
        <input type="submit" name="new-quiz" id="button" class="button-new valider" value="Nouveau Quiz +">
    </form>

    <section class="quiz">

        <?php foreach ($result as $quiz): ?>
            <?php $recupImage = new Image();
            $image = $recupImage->getImageById($quiz['id']); ?>
            <article class="quiz-card">
                <h2 class="quiz-card-title"><?= $quiz['titre'] ?></h2>
                <div class="quiz-card-img">
                    <?php if (!empty($image) && $quiz['id'] == $image[0]['id_quiz']) : ?>
                        <img src="<?= $image[0]['bin'] ?>" alt="<?= $image[0]['nom'] ?>">
                    <?php else : ?>
                        <img src="" alt="Le quiz n'as pas d'image disponible">
                    <?php endif ?>
                </div>
                <p class="quiz-card-description"><?= $quiz['description'] ?></p>
                <form action="" method="post">
                    <input type="hidden" name="<?= $quiz['id'] ?>" value=<?= $quiz['id'] ?>>
                    <?php if (!empty($image)): ?>
                        <input type="hidden" name="<?= $image[0]['id'] ?>" value=<?= $image[0]['id'] ?>>
                    <?php endif ?>
                    <input type="submit" name="view" id="button" class="button valider button-center" value="Afficher">
                </form>
            </article>
        <?php endforeach ?>
    </section>

</main>
<?php include '../component/footer.php'; ?>