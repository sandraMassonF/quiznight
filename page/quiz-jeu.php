<?php

session_start();

include_once('../models/Quiz.php');
include_once('../models/User.php');

$newQuiz = new Quiz();

// Vide la session si joueur parti durant quiz
if (empty($_POST) && isset($_SESSION['wrongAnswer'])) {

    if ($_SESSION['wrongAnswer'] > 0) {

        $scoreQuitter = new Utilisateur();
        $updatedQuitter = $scoreQuitter->updateScore($_SESSION['user'], $_SESSION['score'], $_SESSION['wrongAnswer']);
        $_SESSION['score'] = $updatedQuitter;
        $_SESSION['quitter'] = "Vous avez quitter un quiz en cours...";

        // Reset des sessions lié au quiz après mise a jour score
        unset($_SESSION['questionIndex']);
        unset($_SESSION['answersOrder']);
        unset($_SESSION['answersSubmit']);
        unset($_SESSION['wrongAnswer']);
    } else {
        // Reset des sessions lié au quiz si un quiz a deja été joué
        unset($_SESSION['questionIndex']);
        unset($_SESSION['answersOrder']);
        unset($_SESSION['answersSubmit']);
        unset($_SESSION['wrongAnswer']);
    }
}

// Si message d'erreur du joueur, le detruit
if (isset($_POST['start'])) {
    unset($_SESSION['quitter']);
}

// Erreur page si non connecté
if (!isset($_SESSION['user'])) {
    if (isset($_POST['connexion'])) {
        header('location: connexion.php');
    }
}

// Erreur page si pas de quiz ID
if (!isset($_SESSION['selectIdQuiz'])) {
    $error_message = "Quiz introuvable";
    if (isset($_POST['home'])) {
        header('location: ../index.php');
    }
} else {

    // Lancement du quiz
    $quizSelect = $newQuiz->get_quizSelect($_SESSION['selectIdQuiz']);

    $quizTitle = key($quizSelect);

    // Initialisation de Sessions
    if (!empty($_POST)) {

        // Session - index question
        if (!isset($_SESSION['questionIndex'])) {
            $_SESSION['questionIndex'] = 0;
        }

        // Session - mauvaise réponse
        if (!isset($_SESSION['wrongAnswer'])) {
            $_SESSION['wrongAnswer'] = 0;
        }

        // Bouton suivant qui passe à la question suivante
        if (isset($_POST['next'])) {
            $_SESSION['questionIndex']++;
        }

        // Variables afin de stocker et mélanger l'ordre des réponses
        $numQuestion = $_SESSION['questionIndex'];
        $quizQuestions = $quizSelect[$quizTitle];
        $currentQuestion = array_keys($quizQuestions)[$numQuestion];
        $currentAnswers = $quizQuestions[$currentQuestion];

        // Stock l'ordre des réponses dans un tableau de session
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

        // Vérifie la réponse
        $answerABCD = ['answerA', 'answerB', 'answerC', 'answerD'];
        foreach ($answerABCD as $choice) {
            if (isset($_POST[$choice])) {
                $selectedAnswer = key($_POST);
                $answerSubmit = $_POST[$choice];
                $_SESSION['answerSubmit'] = $answerSubmit;
                $check = $newQuiz->get_checkAnswer($answerSubmit);
                break;
            }
        }

        // Mis à jour score - fin de quiz
        $messageScore = "";
        if (isset($_POST['result'])) {
            $newScore = new Utilisateur();
            $updatedScore = $newScore->updateScore($_SESSION['user'], $_SESSION['score'], $_SESSION['wrongAnswer']);
            $_SESSION['score'] = $updatedScore;
            if ($updatedScore == 0) {
                $messageScore = "Vous êtes éliminé !";
            } else {
                $messageScore = "Vous êtes toujours en vie.";
            }
        }

        // Reset fin de quiz
        if (isset($_POST['home'])) {

            if ($_SESSION['score'] > 0) {
                unset($_SESSION['questionIndex']);
                unset($_SESSION['answersOrder']);
                unset($_SESSION['answersSubmit']);
                unset($_SESSION['wrongAnswer']);
                header('location: ../index.php');
            } else {
                session_destroy();
                header('location: ../index.php');
            }
        }
    }
}

?>

<?php include '../component/header.php'; ?>


<main class="main-james red-suit">

    <!-- Erreur connexion-->
    <?php if (!isset($_SESSION['selectIdQuiz']) or !isset($_SESSION['user'])) : ?>

        <section class="error-box">
            <?php if (!isset($_SESSION['user'])): ?>
                <article>
                    <p>Vous n'êtes pas connecté</p>
                </article>
                <div class="button-box">
                    <form action="" method="post">
                        <input type="submit" name="connexion" id="next" class="button-start button-next-green" value="Connexion">
                    </form>
                </div>

            <?php else: ?>

                <!-- Erreur quiz introuvable -->
                <article>
                    <p>Oops !</p>
                    <p><?= $error_message ?></p>
                </article>
                <div class="button-box">
                    <form action="" method="post">
                        <input type="submit" name="home" id="next" class="button-start button-next-green" value="Accueil">
                    </form>
                </div>
            <?php endif; ?>

        </section>

    <?php else: ?>

        <!-- Pré-lancement - affichage du titre du quiz -->
        <div class="quiz-content-box">
            <section class="title-james">
                <h1 class="quiz-title"><?= $quizTitle; ?></h1>

                <hr class="separator">
            </section>

            <?php if (empty($_POST)): ?>
                <section class="start-box">

                    <!-- Message d'erreur pour ceux qui essaye de reset leur mauvaises réponse en quittant la page -->
                    <?php if (isset($_SESSION['quitter'])) : ?>
                        <div class="msg-quitter">
                            <h4><?= $_SESSION['quitter'] ?></h4>
                            <p>Si vous aviez des mauvaises réponses, celle ci ont été déduite de vos points de vie.</p>
                        </div>
                    <?php endif; ?>

                    <!-- Si élimination après mis à jour du score -->
                    <?php if ($_SESSION['score'] == 0): ?>
                        <div class="start-box-title">
                            <p class="question-text">Vous avez été éliminé.</p>
                            <audio autoplay src="../asset/sounds/LosingAccount.mp3"></audio>
                            <div class="button-box">
                                <form action="" method="post">
                                    <input type="submit" name="home" id="next" class="button-start button-next-green" value="Accueil">
                                </form>
                            </div>
                        </div>
                    <?php else: ?>

                        <!-- Sinon message de pré-lancement -->
                        <div class="start-box-title">
                            <p class="question-text">Vous avez <span class="text-pink"><?= $_SESSION['score'] ?></span> points.</p>
                            <p class="question-text"> Attention aux <span class="text-yellow">mauvaises</span> réponses.. </p>
                        </div>

                        <div class="button-box">
                            <form action="" method="post">
                                <input type="submit" name="start" id="start" class="button-start button-next-green" value="Commencer">
                            </form>
                        </div>
                    <?php endif; ?>

                </section>

                <!-- Affichage fin de quiz -->
            <?php elseif (isset($_POST['result'])): ?>

                <section class="start-box">

                    <div class="start-box-title">
                        <p class="question-text">Vous avez fait
                            <span class="text-pink">
                                <?= $_SESSION['wrongAnswer'] ?>
                            </span>
                            erreurs.
                        </p>
                        <div>
                            <?php if ($updatedScore == 0): ?>
                                <p class="question-text">
                                    <?= $messageScore ?>
                                </p>
                                <audio autoplay src="../asset/sounds/LosingAccount.mp3"></audio>
                            <?php else: ?>
                                <p class="question-text"><?= $messageScore ?></p>
                                <p class="question-text">Nombre de vies restantes : <span class="text-pink bold"><?= $_SESSION['score'] ?></span></p>
                            <?php endif; ?>
                        </div>

                    </div>

                    <div class="button-box">
                        <form action="" method="post">
                            <input type="submit" name="home" id="next" class="button-start button-next-green" value="Accueil">
                        </form>
                    </div>
                </section>
            <?php else: ?>

                <!-- Section jeu lancé - affichage questions -->
                <section class="question-box">

                    <div class="question-box-title">
                        <p class="quiz-text-question bold">Question
                            <span class="text-pink">#
                                <?= $numQuestion + 1 ?>

                            </span>
                        </p>

                        <p class="quiz-text-question"><?= $currentQuestion; ?></p>
                    </div>

                    <!-- Section jeu lancé - réponses clickable -->
                    <?php if (
                        !isset($_POST['answerA']) and !isset($_POST['answerB'])
                        and !isset($_POST['answerC']) and !isset($_POST['answerD'])
                    ) : ?>

                        <form action="" method="post" class="question-box-answers">
                            <?php foreach ($shuffledAnswers as $key => $id_rep): ?>
                                <?php if ($key == 0): ?>
                                    <button type="submit" name="answerA" id="answerA" class="button-answer default cercle-answer"
                                        value="<?= $id_rep['result'] ?>"><?= $id_rep['answer'] ?></button>
                                <?php endif; ?>
                                <?php if ($key == 1): ?>
                                    <button type="submit" name="answerB" id="answerB" class="button-answer default umbrella-answer"
                                        value="<?= $id_rep['result'] ?>"><?= $id_rep['answer'] ?></button>
                                <?php endif; ?>
                                <?php if ($key == 2): ?>
                                    <button type="submit" name="answerC" id="answerC" class="button-answer default triangle-answer"
                                        value="<?= $id_rep['result'] ?>"><?= $id_rep['answer'] ?></button>
                                <?php endif; ?>
                                <?php if ($key == 3): ?>
                                    <button type="submit" name="answerD" id="answerD" class="button-answer default square-answer"
                                        value="<?= $id_rep['result'] ?>"><?= $id_rep['answer'] ?></button>
                        </form>
                    <?php endif; ?>
                <?php endforeach; ?>

            <?php else: ?>

                <!-- Affichage de la bonne réponse / mauvaise réponse -->

                <div class="question-box-answers">
                    <?php foreach ($shuffledAnswers as $key => $id_rep): ?>

                        <?php if ($key == 0): ?>
                            <!-- Réponse A -->
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
                            <!-- Réponse B -->
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
                            <!-- Réponse C -->
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
                            <!-- Réponse D -->
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
                    <?php endforeach; ?>
                </div>

                <!-- Boutons : Suivant ou Accueil -->
                <?php if ($_SESSION['questionIndex'] == count($quizQuestions) - 1): ?>
                    <div class="button-box">
                        <form action="" method="post">
                            <input type="submit" name="result" id="next" class="button-next button-next-green" value="Résultat">
                        </form>
                    <?php else: ?>
                        <div class="button-box">
                            <form action="" method="post">
                                <input type="submit" name="next" id="next" class="button-next button-next-green" value="Suivant">
                            </form>
                        <?php endif; ?>
                    <?php endif; ?>
                        </div>
                </section>

            <?php endif; ?>
        <?php endif; ?>
        </div>
</main>

<?php include '../component/footer.php'; ?>