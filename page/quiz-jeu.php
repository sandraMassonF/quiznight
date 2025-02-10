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
        <h1>{Nom du quiz}</h1>
    </section>

    <hr>

    <section class="question-box">
        <div class="question-box-title">
            <h2>Question #{}</h2>
            <h4>{Lalala question lalala question lalala question ?}</h4>
        </div>
        <div class="question-box-answers">
            <form action="" method="post">
                <input type="submit" name="answerA" id="answer" value="1 / blablabla">
            </form>
            <form action="" method="post">
                <input type="submit" name="answerB" id="answer" value="2 / blablabla">
            </form>
            <form action="" method="post">
                <input type="submit" name="answerC" id="answer" value="3 / blablabla">
            </form>
            <form action="" method="post">
                <input type="submit" name="answerD" id="answer" value="4 / blablabla">
            </form>
            <br>
            <br>
            <form action="" method="post">
                <input type="submit" name="valid" id="answer" value="Valider">
            </form>
            <form action="" method="post">
                <input type="submit" name="next" id="answer" value="Suivant">
            </form>
            <form action="" method="post">
                <input type="submit" name="home" id="answer" value="Accueil">
            </form>
        </div>


    </section>


</main>
</body>

</html>