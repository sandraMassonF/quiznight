<?php
require '../config.php';
session_start();
include_once("../models/Quiz.php");
include_once("../models/Image.php");
if (isset($_POST['valid'])) {
    $titre = htmlspecialchars($_POST['titre']);
    $description = htmlspecialchars($_POST['description']);
    $id_user = $_SESSION['user'];
    $newQuiz = new Quiz();
    $newQuiz->createQuiz($titre, $description, $id_user);
    $lastQuiz = $newQuiz->getLastQuiz();
    $_SESSION['quizId'] = $lastQuiz[0]['id'];
    $titreQuiz = $lastQuiz[0]['titre'];
    $descriptionQuiz = $lastQuiz[0]['description'];
};
if (isset($_POST['valid-image'])) {
    $image = new Image();
    $newImage = $image->createImage($_FILES['image']['name'], $_FILES['image']['size'], $_FILES['image']['type'], $_FILES['image']['tmp_name'], $_SESSION['quizId']);
    header('location: ./autor-modif-quiz.php');
}
?>



<?php include '../components/header.php'; ?>
<main class="autor-quiz">

    <h1 class="autor-title">Nouveau quiz</h1>

    <?php if (!isset($_POST['valid'])): ?>
        <form action="" method="post">
            <input type="text" name="titre" class="name" placeholder="Non du Quiz">
            <input type="text" name="description" class="name" placeholder="Description du Quiz">
            <input type="submit" name="valid" id="button" class="button valider button-center" value="Valider">
        </form>
    <?php elseif (isset($_POST['valid'])): ?>
        <h2 class="title-quiz"><?= $titreQuiz ?></h2>
        <h3 class="description-quiz"><?= $descriptionQuiz ?></h3>
        <form enctype="multipart/form-data" action="" method="post">
            <input type="file" name="image" class="name">
            <input type="submit" name="valid-image" id="button" class="button valider button-center" value="Valider">
        </form>
    <?php endif ?>
</main>
<?php include '../components/footer.php'; ?>