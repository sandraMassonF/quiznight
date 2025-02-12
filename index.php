<?php
session_start();

include_once './page/Class.Bdd.php';
include_once './page/Class.Quiz.php';


$newQuiz = new Quiz();
$quizUser = $newQuiz->getAllQuiz();



?>

<!DOCTYPE html>
<html lang="fr">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./asset/css/header-footer.css">
<link rel="stylesheet" href="../asset/css/style_connexion.css">
<link rel="stylesheet" href="../asset/css/style_quiz-jeu.css">

<title>S-Quiz Game</title>
</head>

<body>
    <header class="header">
        <div class="logo-box">
            <a href="index.php">
                <img src="./asset/img/accueil-logo.png" class="logo-header"/>
            </a>
        </div>
        <div class="box-symbol">
            <img class="symbol-header" src="./asset/img/titre-logo.png" />
        </div>
        
        <?php if (isset($_SESSION['user'])) :?>
            <form method="post">
                    <button class="disconnect_btn login" type="submit" name="deconnexion">Déconnexion</button>
            </form>
         <?php
                if (isset($_POST['deconnexion'])) {
                    $_SESSION = array();
                    session_destroy();
                    header("Location:index.php");
                }
          ?>
        <?php else : ?>
            <div class="login">
            <a href="./page/connexion.php">Connexion</a>
            </div>
        <?php endif ?>
        
    </header>

    <div class="quiz-container">
    <?php foreach ($quizUser as $quiz): ?>
        <div class="quiz-card">
            <h2><?= $quiz['titre'] ?></h2>
            <p><?= $quiz['description'] ?></p>
            <p><strong>Créé par :</strong> <?= htmlspecialchars($quiz['pseudo']) ?></p>           
            <img src="<?= $quiz['image'] ?>" alt="Image du quiz">      
            <a href="quiz_detail.php?id=<?= $quiz['id'] ?>">Voir le quiz</a>
        </div>
    <?php endforeach; ?>
    </div>


    <?php include './component/footer.php'; ?>