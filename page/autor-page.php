<?php
session_start();
include('../models/Quiz.php');
$userId = 1;
if (!isset($_SESSION['userId'])) {
    $_SESSION['userId'] = $userId;
}
if (isset($_POST['view'])) {
    $_SESSION['quizId'] = array_keys($_POST)[0];
    echo $_SESSION['quizId'];
    header("location: ./autor-modif-quiz.php");
};
if (isset($_POST['new-quiz'])) {
    header("location: ./autor-new-quiz.php");
};

$quiz = new Quiz();
$result = $quiz->getQuizUser(1);


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








        <!-- <article class="quiz-card">
            <h2 class="quiz-card-title">Titre</h2>
            <div class="quiz-card-img">
                <img src="../asset/img/sonGoku.jpg" alt="san goku et les boules de cristal">
            </div>
            <p class="quiz-card-description">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nesciunt consequatur quasi molestiae. Doloremque minus placeat illum quo mollitia dignissimos odit voluptas beatae, voluptatem molestias dolores, veniam, rem non expedita alias omnis? Nostrum dolor</p>
            <form action="" method="post">
                <input type="submit" name="view" id="button" class="button valider button-center" value="Afficher">
            </form>
        </article>
        <article class="quiz-card">
            <h2 class="quiz-card-title">Titre</h2>
            <div class="quiz-card-img">
                <img src="../asset/img/sonGoku.jpg" alt="san goku et les boules de cristal">
            </div>
            <p class="quiz-card-description">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nesciunt consequatur quasi molestiae. Doloremque minus placeat illum quo mollitia dignissimos odit voluptas beatae, voluptatem molestias dolores, veniam, rem non expedita alias omnis? Nostrum dolor</p>
            <form action="" method="post">
                <input type="submit" name="view" id="button" class="button valider button-center" value="Afficher">
            </form>
        </article>
        <article class="quiz-card">
            <h2 class="quiz-card-title">Titre</h2>
            <div class="quiz-card-img">
                <img src="#" alt="san goku et les boules de cristal">
            </div>
            <p class="quiz-card-description">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nesciunt consequatur quasi molestiae. Doloremque minus placeat illum quo mollitia dignissimos odit voluptas beatae, voluptatem molestias dolores, veniam, rem non expedita alias omnis? Nostrum dolor</p>
            <form action="" method="post">
                <input type="submit" name="view" id="button" class="button valider button-center" value="Afficher">
            </form>
        </article> -->

    </section>



</main>
<?php include '../component/footer.php'; ?>