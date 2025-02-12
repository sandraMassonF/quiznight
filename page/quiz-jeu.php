<?php

session_start();

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


// question actuelle

$numQuestion = 0;
$quizTitle = key($quizSelect);
$quizQuestions = $quizSelect[$quizTitle];
$currentQuestion = array_keys($quizQuestions)[$numQuestion];
$currentAnswers = $quizQuestions[$currentQuestion];

if (!isset($_SESSION['questionIndex'])) {
    $_SESSION['questionIndex'] = $numQuestion;
} else {
    $_SESSION['questionIndex'] = $numQuestion;
}

if (isset($_POST['answer'])) {
    $check = $newQuiz->get_checkAnswer();
    if ($check == true) {
    }
}



?>

<?php include '../component/header.php'; ?>

<main class="main-james">

    <?php var_dump(array_keys($quizQuestions)) ?>

    <section class="title-james">
        <h1 class="quiz-title"><?= $quizTitle; ?></h1>
    </section>

    <hr class="separator">

    <!-- boite question -->


    <section class="question-box">

        <div class="question-box-title">
            <h2 class="bold">Question
                <span class="text-pink">#
                    <?= $numQuestion + 1 ?>
                </span>
            </h2>

            <p class="question-text"><?= $currentQuestion; ?></p>
        </div>

        <!-- réponses  -->

        <div class="question-box-answers">
            <?php foreach ($currentAnswers as $key => $id_rep): ?>
                <?php if ($key == 0): ?>

                    <form action="" method="post">
                        <button type="submit" name="answer" id="answer" class="button-answer cercle-answer"
                            value="<?= $id_rep['result'] ?>"><?= $id_rep['answer'] ?></button>
                    </form>

                <?php endif; ?>
                <?php if ($key == 1): ?>
                    <form action="" method="post">
                        <button type="submit" name="answer" id="answer" class="button-answer triangle-answer"
                            value="<?= $id_rep['result'] ?>"><?= $id_rep['answer'] ?></button>
                    </form>
                <?php endif; ?>
                <?php if ($key == 2): ?>
                    <form action="" method="post">
                        <button type="submit" name="answer" id="answer" class="button-answer square-answer"
                            value="<?= $id_rep['result'] ?>"><?= $id_rep['answer'] ?></button>
                    </form>
                <?php endif; ?>
                <?php if ($key == 3): ?>
                    <form action="" method="post">
                        <button type="submit" name="answer" id="answer" class="button-answer umbrella-answer"
                            value="<?= $id_rep['result'] ?>"><?= $id_rep['answer'] ?></button>
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


    </section>


</main>

<?php include '../component/footer.php'; ?>