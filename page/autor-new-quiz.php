<?php
if (isset($_POST['valid'])) {
    header("location: ./autor-modif-quiz.php");
};
?>



<?php include '../component/header.php'; ?>
<main class="autor-new-quiz">

    <h1 class="autor-title">Nouveau quiz</h1>


    <form action="" method="post">
        <input type="text" name="name-quiz" class="name">
        <input type="submit" name="valid" id="button" class="button valider button-center" value="Valider">
    </form>
</main>
<?php include '../component/footer.php'; ?>