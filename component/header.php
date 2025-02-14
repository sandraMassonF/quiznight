<?php

if (!empty($_SESSION)) {

    // deconnexion
    if (isset($_POST['deconnexion'])) {
        $_SESSION = array();
        session_destroy();
        header("Location: ../index.php");
    }
    if (isset($_POST['mon-compte'])) {
        if (isset($_SESSION['user'])) {
            header("Location: ./autor-page.php");
        }
    };
};


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../asset/css/style_header-footer.css">
    <link rel="stylesheet" href="../asset/css/style_connexion.css">
    <link rel="stylesheet" href="../asset/css/style_quiz-jeu.css">
    <link rel="stylesheet" href="../asset/css/style_autor-page.css">
    <link rel="stylesheet" href="../asset/css/style_add-modif-question.css">
    <link rel="stylesheet" href="../asset/css/style_add-modif-quiz.css">
    <link rel="stylesheet" href="../asset/css/style_index.css">
    <title>S-Quiz Game</title>
</head>

<body>

    <header class="header">
        <?php if (empty($_SESSION)): ?>

            <!-- pas connecté  -->
            <div class="logo-box">
                <a href="../index.php">
                    <img src="../asset/img/accueil-logo.png" class="logo-header" alt="connexion" />
                </a>
            </div>

            <img class="quiz-logo" src="../asset/img/titre-logo.png" />

            <div class="logo-login">
                <a href="../page/connexion.php">
                    <img src="../asset/img/utilisateur.png">
                </a>
            </div>

        <?php else: ?>

            <!-- connecté -->

            <div class="logo-box">
                <a href="../index.php">
                    <img src="../asset/img/accueil-logo.png" class="logo-header" alt="connexion" />
                </a>
            </div>

            <img class="quiz-logo" src="../asset/img/titre-logo.png" />


            <form method="post" action="" class="box-login-disconnect">

                <button class="icon-account header-user-logo" type="submit" name="mon-compte">
                    <div class="box-account">
                        <img src="../asset/img/utilisateur.png" />
                    </div>
                    <p class="login ">{001}</p>
                </button>

                <button class="icon-account" type="submit" name="deconnexion">
                    <img src="../asset/img/deconnexion.png" alt="deconnexion" />
                </button>

            </form>

        <?php endif; ?>

    </header>