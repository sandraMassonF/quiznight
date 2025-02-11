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

require_once('../models/Quiz.php');

$newQuiz = new Quiz(1);
$quizSelect = $newQuiz->get_quizSelect();
$numQuestion = 1;
?>

<?php include '../component/header.php'; ?>

<main class="main-james">

    <?php foreach ($quizSelect as $quizTitle => $quizQuestions): ?>

        <section class="title-james">
            <h1 class="quiz-title"><?= $quizTitle; ?></h1>
        </section>

        <hr class="separator">

        <!-- boite question -->


        <section class="question-box">
            <?php foreach ($quizQuestions as $question => $reponses): ?>
                <div class="question-box-title">
                    <h2 class="bold">Question
                        <span class="text-pink">#
                            <?php if ($numQuestion <= count($quizQuestions)): ?>
                                <?= $numQuestion++ ?>
                            <?php endif; ?>
                        </span>
                    </h2>

                    <p class="question-text"><?= $question; ?></p>
                </div>

                <!-- réponses  -->

                <div class="question-box-answers">
                    <?php foreach ($reponses as $key => $id_rep): ?>
                        <?php if ($key == 0): ?>
                            <form action="" method="post">
                                <input type="submit" name="answerA" id="answer" class="button-answer cercle-answer"
                                    value="<?= $id_rep['answer'] ?>">
                            </form>
                        <?php endif; ?>
                        <?php if ($key == 1): ?>
                            <form action="" method="post">
                                <input type="submit" name="answerB" id="answer" class="button-answer triangle-answer"
                                    value="<?= $id_rep['answer'] ?>">
                            </form>
                        <?php endif; ?>
                        <?php if ($key == 2): ?>
                            <form action="" method="post">
                                <input type="submit" name="answerC" id="answer" class="button-answer square-answer"
                                    value="<?= $id_rep['answer'] ?>">
                            </form>
                        <?php endif; ?>
                        <?php if ($key == 3): ?>
                            <form action="" method="post">
                                <input type="submit" name="answerD" id="answer" class="button-answer umbrella-answer"
                                    value="<?= $id_rep['answer'] ?>">
                            </form>
                        <?php endif; ?>
                    <?php endforeach; ?>
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

            <?php endforeach; ?>
        </section>
    <?php endforeach; ?>

</main>

<?php include '../component/footer.php'; ?>