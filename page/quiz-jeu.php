<?php

$host = "localhost";
$username = "root";
$password = "";

// CONNEXION à la base de donnée
try {
    $bdd  = new PDO("mysql:host=$host;dbname=s-quiz_game;charset=utf8", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

?>

<?php include '../component/header.php'; ?>

<main class="main-james">

    <section class="title-james">
        <h1 class="quiz-title">{Nom du quiz}</h1>
    </section>

    <hr class="separator">

    <section class="question-box">
        <div class="question-box-title">
            <h2 class="bold">Question <span class="text-pink">#{}</span></h2>
            <p class="question-text">{Lalala question lalala question lalala question ?}</p>
        </div>

        <!-- réponses  -->
        <div class="question-box-answers">
            <!-- prévoir if pour changer design class de l'input -->
            <form action="" method="post">
                <input type="submit" name="answerA" id="answer" class="button-answer" value="1 / {blablabla}">
            </form>
            <form action="" method="post">
                <input type="submit" name="answerB" id="answer" class="button-answer" value="2 / {blablabla}">
            </form>
            <form action="" method="post">
                <input type="submit" name="answerC" id="answer" class="button-answer" value="3 / {blablabla}">
            </form>
            <form action="" method="post">
                <input type="submit" name="answerD" id="answer" class="button-answer" value="4 / {blablabla}">
            </form>

        </div>
        <!-- button valider, suivant, retour accueil -->
        <div class="button-box">
            <form action="" method="post">
                <input type="submit" name="valid" id="button" class="button valider" value="Valider">
            </form>
            <!-- <form action="" method="post">
                <input type="submit" name="next" id="button" value="Suivant">
            </form>
            <form action="" method="post">
                <input type="submit" name="home" id="button" value="Accueil">
            </form> -->

        </div>


    </section>


</main>

<?php include '../component/footer.php'; ?>