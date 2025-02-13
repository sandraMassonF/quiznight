<?php
session_start();

include("../models/Quiz.php");
if (isset($_POST['valid'])) {
    $titre = htmlspecialchars($_POST['titre']);
    $description = htmlspecialchars($_POST['description']);
    $image = htmlspecialchars($_POST['image']);
    $id_user = $_SESSION['user'];
    $quizUpdate = new Quiz();
    $quizUpdate->createQuiz($titre, $description, $image, $id_user);
    header("location: ./autor-page.php");
};
?>



<?php include '../component/header.php'; ?>
<main class="autor-quiz">

    <h1 class="autor-title">Nouveau quiz</h1>


    <form action="" method="post">
        <input type="text" name="titre" class="name" placeholder="Non du Quiz">
        <input type="text" name="description" class="name" placeholder="Description du Quiz">
        <!-- <input type="text" name="image" class="name" placeholder="Image ilustration"> -->
        <input type="file" name="image" class="name">
        <input type="submit" name="valid" id="button" class="button valider button-center" value="Valider">
    </form>
</main>
<?php include '../component/footer.php'; ?>