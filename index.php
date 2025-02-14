<?php
session_start();

include_once './models/Quiz.php';

if (isset($_POST['start-quiz'])) {
    $selectIdQuiz = $_POST['start-quiz'];
    $_SESSION['selectIdQuiz'] = $selectIdQuiz;
};

if (!empty($_SESSION)) {

    // deconnexion
    if (isset($_POST['deconnexion'])) {
        $_SESSION = array();
        session_destroy();
        header("Location: index.php");
    }
    if (isset($_POST['mon-compte'])) {
        if (isset($_SESSION['user'])) {
            header("Location: ./page/autor-page.php");
        }
    };
};
$newQuiz = new Quiz();
$quizUser = $newQuiz->getAllQuizByUser();
?>

<!DOCTYPE html>
<html lang="fr">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./asset/css/style_header-footer.css">
<link rel="stylesheet" href="./asset/css/style_connexion.css">
<link rel="stylesheet" href="./asset/css/style_quiz-jeu.css">
<link rel="stylesheet" href="./asset/css/style_autor-page.css">
<link rel="stylesheet" href="./asset/css/style_index.css">

<title>S-Quiz Game</title>
</head>

<body>

    <header class="header">
        <?php if (!isset($_SESSION['user'])): ?>

            <!-- pas connecté  -->
            <div class="logo-box">
                <a href="index.php">
                    <img src="./asset/img/accueil-logo.png" class="logo-header" alt="connexion" />
                </a>
            </div>

            <img class="quiz-logo" src="./asset/img/titre-logo.png" />

            <div class="logo-login">
                <a href="./page/connexion.php">
                    <img src="./asset/img/utilisateur.png">
                </a>
            </div>

        <?php else: ?>

            <!-- connecté -->

            <div class="logo-box">
                <a href="index.php">
                    <img src="./asset/img/accueil-logo.png" class="logo-header" alt="connexion" />
                </a>
            </div>

            <img class="quiz-logo" src="./asset/img/titre-logo.png" />


            <form method="post" action="" class="box-login-disconnect">

                <button class="icon-account header-user-logo" type="submit" name="mon-compte">
                    <div class="box-account">
                        <img src="./asset/img/utilisateur.png" />
                    </div>
                    <p class="login "><?= "{ " . $_SESSION['userNumber'] . " }" ?></p>
                </button>

                <button class="icon-account" type="submit" name="deconnexion">
                    <img src="./asset/img/deconnexion.png" alt="deconnexion" />
                </button>

            </form>

        <?php endif; ?>

    </header>

    <main class="autor-page">

        <div class="classement">
            <img src="./asset/img/score.png" alt="medaille">
            <span><a href="./page/leaderboard.php" class="btn-classement">AFFICHER LE CLASSEMENT</a></span>
            <img src="./asset/img/score.png" alt="medaille" width="50rem">
        </div>


        <section class="quiz">
            <?php foreach ($quizUser as $quiz): ?>
                <article class="quiz-card">
                    <h2 class="quiz-card-title"><?= $quiz['titre'] ?></h2>
                    <div class="quiz-card-img">
                        <img src="./asset/img/sonGoku.jpg" alt="Image du quiz">
                    </div>
                    <p class="quiz-card-description"><?= $quiz['description'] ?></p>
                    <form method="post" action="">
                        <button type="submit" name="start-quiz" id="button" class="button valider button-center" value="<?= $quiz['id'] ?>">Lancer le Quiz</button>
                        <?php if (isset($_POST['start-quiz'])) {
                            header("location:./page/quiz-jeu.php");
                        };
                        ?>
                    </form>
                    <p class="quiz-autor">Créé par : <?= $quiz['pseudo'] ?></p>
                </article>
            <?php endforeach; ?>

        </section>
    </main>


    <?php include './component/footer.php'; ?>