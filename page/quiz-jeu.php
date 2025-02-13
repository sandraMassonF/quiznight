<?php

session_start();

include_once('../models/Quiz.php');
include_once('../models/User.php');

$newQuiz = new Quiz();

// $_SESSION['user'] = 2;
// $_SESSION['score'] = 10;

//recup quiz selectionné --- parametre = valeur session select 
// $_SESSION['selectIdQuiz'] = 1;

// erreur page si non connecté
if (!isset($_SESSION['user'])) {
    if (isset($_POST['connexion'])) {
        header('location: connexion.php');
    }
}
// erreur page si pas de quiz ID
if (!isset($_SESSION['selectIdQuiz'])) {
    $error_message = "Quiz introuvable";
    if (isset($_POST['home'])) {
        header('location: ../index.php');
    }
} else {
    $quizSelect = $newQuiz->get_quizSelect($_SESSION['selectIdQuiz']);

    $quizTitle = key($quizSelect);

    // -------------------------------------

    $messageScore = "";
    if (isset($_POST['result'])) {
        $newScore = new Utilisateur();
        $updatedScore = $newScore->updateScore($_SESSION['user'], $_SESSION['score'], $_SESSION['wrongAnswer']);
        $_SESSION['score'] = $updatedScore;
        if ($updatedScore == 0) {
            $messageScore = "Vous êtes éliminé !";
        } else {
            $messageScore = "Bravo !";
        }
    }


    // reset fin de quiz
    if (isset($_POST['home'])) {

        if ($_SESSION['score'] > 0) {
            unset($_SESSION['questionIndex']);
            unset($_SESSION['answersOrder']);
            unset($_SESSION['answersSubmit']);
            unset($_SESSION['rightAnswer']);
            unset($_SESSION['wrongAnswer']);
        } else {
            session_destroy();
        }

        header('location: ../index.php');
    }

    //-------------------------------------------------------------
    // récupère la réponse choisi et vérifie si elle est vraie
    if (!empty($_POST)) {

        if (!isset($_SESSION['questionIndex'])) {
            $_SESSION['questionIndex'] = 0;
        }

        // session bonne réponse
        if (!isset($_SESSION['rightAnswer'])) {
            $_SESSION['rightAnswer'] = 0;
        }

        // session mauvaise réponse
        if (!isset($_SESSION['wrongAnswer'])) {
            $_SESSION['wrongAnswer'] = 0;
        }

        if (isset($_POST['next'])) {
            $_SESSION['questionIndex']++;
        }

        $numQuestion = $_SESSION['questionIndex'];
        $quizQuestions = $quizSelect[$quizTitle];
        $currentQuestion = array_keys($quizQuestions)[$numQuestion];
        $currentAnswers = $quizQuestions[$currentQuestion];

        // stock l'ordre des réponses dans un tableau de session
        if (!isset($_SESSION['answersOrder'][$numQuestion])) {
            $_SESSION['answersOrder'][$numQuestion] = array_keys($currentAnswers);
            // mélange les clés du tableau de reponses
            shuffle($_SESSION['answersOrder'][$numQuestion]);
        }

        //  Tableau pour récuperer les réponses après mélange afin de les utiliser
        $shuffledAnswers = [];
        foreach ($_SESSION['answersOrder'][$numQuestion] as $key) {
            $shuffledAnswers[] = $currentAnswers[$key];
        }

        $answerABCD = ['answerA', 'answerB', 'answerC', 'answerD'];
        foreach ($answerABCD as $choice) {
            if (isset($_POST[$choice])) {
                $selectedAnswer = key($_POST);
                $answerSubmit = $_POST[$choice];
                $_SESSION['answerSubmit'] = $answerSubmit;
                $check = $newQuiz->get_checkAnswer($answerSubmit);
                $rightAnswer = $_SESSION['rightAnswer'];
                break;
            }
        }
    }
}

?>

<?php include '../component/header.php'; ?>


<main class="main-james">


    <?php

    // var_dump($_POST);
    var_dump($_SESSION);
    // var_dump($currentAnswers);
    ?>

    <!-- erreur -->

    <?php if (!isset($_SESSION['selectIdQuiz']) or !isset($_SESSION['user'])) : ?>

        <section class="error-box">
            <?php if (!isset($_SESSION['user'])): ?>
                <article>
                    <p>Vous n'êtes pas connecté</p>

                </article>
                <div class="button-box">
                    <form action="" method="post">
                        <input type="submit" name="connexion" id="next" class="button-next" value="Connexion">
                    </form>
                </div>
            <?php else: ?>
                <article>
                    <p>Oops !</p>
                    <p><?= $error_message ?></p>
                </article>
                <div class="button-box">
                    <form action="" method="post">
                        <input type="submit" name="home" id="next" class="button-next" value="Accueil">
                    </form>
                </div>
            <?php endif; ?>




        </section>


    <?php else: ?>

        <section class="title-james">
            <h1 class="quiz-title"><?= $quizTitle; ?></h1>
        </section>

        <hr class="separator">

        <!-- pré start -->

        <?php if (empty($_POST)): ?>
            <section class="start-box">

                <div class="start-box-title">
                    <h2 class="bold">Vous avez <span class="text-pink"><?= $_SESSION['score'] ?></span> points

                        <p> Attention aux <span class="text-pink">mauvaises</span> réponses </p>
                    </h2>
                </div>

                <div class="button-box">
                    <form action="" method="post">
                        <input type="submit" name="start" id="start" class="button-next" value="Commencer">
                    </form>
                </div>
            </section>

        <?php elseif (isset($_POST['result'])): ?>

            <section class="start-box">

                <div class="start-box-title">
                    <h2 class="bold">Vous avez fait
                        <span class="text-pink">
                            <?= $_SESSION['wrongAnswer'] ?>
                        </span>
                        erreurs.
                    </h2>
                    <h2><?= $messageScore ?></h2>
                    <?php if ($updatedScore == 0): ?>
                        <p>
                            Quel dommage.
                        </p>
                    <?php else: ?>
                        <p class="question-text">Vous êtes toujours en vie.</p>
                        <p class="question-text">Votre nombre de vie est de : <?= $_SESSION['score'] ?></p>
                    <?php endif; ?>
                </div>

                <div class="button-box">
                    <form action="" method="post">
                        <input type="submit" name="home" id="next" class="button-next" value="Accueil">
                    </form>
                </div>
            </section>
        <?php else: ?>
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

                <!-- réponses a choisir -->
                <?php if (
                    !isset($_POST['answerA']) and !isset($_POST['answerB'])
                    and !isset($_POST['answerC']) and !isset($_POST['answerD'])
                ) : ?>
                    <div class="question-box-answers">

                        <?php foreach ($shuffledAnswers as $key => $id_rep): ?>
                            <?php if ($key == 0): ?>

                                <form action="" method="post">
                                    <button type="submit" name="answerA" id="answerA" class="button-answer default cercle-answer"
                                        value="<?= $id_rep['result'] ?>"><?= $id_rep['answer'] ?></button>
                                </form>

                            <?php endif; ?>
                            <?php if ($key == 1): ?>
                                <form action="" method="post">
                                    <button type="submit" name="answerB" id="answerB" class="button-answer default umbrella-answer"
                                        value="<?= $id_rep['result'] ?>"><?= $id_rep['answer'] ?></button>
                                </form>
                            <?php endif; ?>
                            <?php if ($key == 2): ?>
                                <form action="" method="post">
                                    <button type="submit" name="answerC" id="answerC" class="button-answer default triangle-answer"
                                        value="<?= $id_rep['result'] ?>"><?= $id_rep['answer'] ?></button>
                                </form>
                            <?php endif; ?>
                            <?php if ($key == 3): ?>
                                <form action="" method="post">
                                    <button type="submit" name="answerD" id="answerD" class="button-answer default square-answer"
                                        value="<?= $id_rep['result'] ?>"><?= $id_rep['answer'] ?></button>
                                </form>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <!-- affichage des réponses -->
                    <div class="question-box-answers">
                        <?php foreach ($shuffledAnswers as $key => $id_rep): ?>

                            <?php if ($key == 0): ?>
                                <!--  -->
                                <?php if ($selectedAnswer == "answerA" and $check == 1): ?>
                                    <div class="answerValid button-answer cercle-answer">
                                        <p class="answer-text"><?= $id_rep['answer'] ?></p>
                                    </div>
                                <?php elseif ($selectedAnswer == "answerA" and $check == 0): ?>
                                    <div class="answerFalse button-answer cercle-answer">
                                        <p class="answer-text"><?= $id_rep['answer'] ?></p>
                                    </div>
                                <?php elseif ($selectedAnswer != "answerA" and $id_rep['result'] == 1): ?>
                                    <div class="answerTrue button-answer cercle-answer">
                                        <p class="answer-text true-false"><?= $id_rep['answer'] ?></p>
                                    </div>
                                <?php else: ?>
                                    <div class="noAnswer button-answer cercle-answer">
                                        <p class="answer-text"><?= $id_rep['answer'] ?></p>
                                    </div>
                                <?php endif; ?>
                                <!--  -->
                            <?php endif; ?>
                            <?php if ($key == 1): ?>
                                <!--  -->
                                <?php if ($selectedAnswer == "answerB" and $check == 1): ?>
                                    <div class="answerValid button-answer umbrella-answer">
                                        <p class="answer-text"><?= $id_rep['answer'] ?></p>
                                    </div>
                                <?php elseif ($selectedAnswer == "answerB" and $check == 0): ?>
                                    <div class="answerFalse button-answer umbrella-answer">
                                        <p class="answer-text"><?= $id_rep['answer'] ?></p>
                                    </div>
                                <?php elseif ($selectedAnswer != "answerB" and $id_rep['result'] == 1): ?>
                                    <div class="answerTrue button-answer umbrella-answer">
                                        <p class="answer-text true-false"><?= $id_rep['answer'] ?></p>
                                    </div>
                                <?php else: ?>
                                    <div class="noAnswer button-answer umbrella-answer">
                                        <p class="answer-text"><?= $id_rep['answer'] ?></p>
                                    </div>
                                <?php endif; ?>
                                <!--  -->
                            <?php endif; ?>
                            <?php if ($key == 2): ?>
                                <!--  -->
                                <?php if ($selectedAnswer == "answerC" and $check == 1): ?>
                                    <div class="answerValid button-answer triangle-answer">
                                        <p class="answer-text"><?= $id_rep['answer'] ?></p>
                                    </div>
                                <?php elseif ($selectedAnswer == "answerC" and $check == 0): ?>
                                    <div class="answerFalse button-answer triangle-answer">
                                        <p class="answer-text"><?= $id_rep['answer'] ?></p>
                                    </div>
                                <?php elseif ($selectedAnswer != "answerC" and $id_rep['result'] == 1): ?>
                                    <div class="answerTrue button-answer triangle-answer">
                                        <p class="answer-text true-false"><?= $id_rep['answer'] ?></p>
                                    </div>
                                <?php else: ?>
                                    <div class="noAnswer button-answer triangle-answer">
                                        <p class="answer-text"><?= $id_rep['answer'] ?></p>
                                    </div>
                                <?php endif; ?>
                                <!--  -->
                            <?php endif; ?>
                            <?php if ($key == 3): ?>
                                <!--  -->
                                <?php if ($selectedAnswer == "answerD" and $check == 1): ?>
                                    <div class="answerValid button-answer square-answer">
                                        <p class="answer-text"><?= $id_rep['answer'] ?></p>
                                    </div>
                                <?php elseif ($selectedAnswer == "answerD" and $check == 0): ?>
                                    <div class="answerFalse button-answer square-answer">
                                        <p class="answer-text"><?= $id_rep['answer'] ?></p>
                                    </div>
                                <?php elseif ($selectedAnswer != "answerD" and $id_rep['result'] == 1): ?>
                                    <div class="answerTrue button-answer square-answer">
                                        <p class="answer-text true-false"><?= $id_rep['answer'] ?></p>
                                    </div>
                                <?php else: ?>
                                    <div class="noAnswer button-answer square-answer">
                                        <p class="answer-text"><?= $id_rep['answer'] ?></p>
                                    </div>
                                <?php endif; ?>
                                <!--  -->
                            <?php endif; ?>
                    </div>
                <?php endforeach; ?>
                </div>
                <!-- button valider, suivant, retour accueil -->
                <?php if ($_SESSION['questionIndex'] == count($quizQuestions) - 1): ?>
                    <div class="button-box">
                        <form action="" method="post">
                            <input type="submit" name="result" id="next" class="button-next" value="Résultat">
                        </form>
                    <?php else: ?>
                        <div class="button-box">
                            <form action="" method="post">
                                <input type="submit" name="next" id="next" class="button-next" value="Suivant">
                            </form>
                        <?php endif; ?>
                    <?php endif; ?>

            </section>



        <?php endif; ?>
    <?php endif; ?>

</main>

<?php include '../component/footer.php'; ?>