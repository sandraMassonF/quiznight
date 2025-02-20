<?php
require '../config.php';
include_once '../models/User.php';

$newIns = new Utilisateur();
$newInscription = $newIns->inscription();

?>

<?php include '../component/header.php' ?>

<main class="main">
    <section>
        <!-- si une session est déjà ouverte on ne propose pas de se reconnecter -->
        <?php if (isset($_SESSION['user'])) : ?>
            <?php header("location:connexion.php"); ?>
            <!-- si pas de session ouverte on propose de se connecter -->
        <?php else : ?>
            <h1 class="titreh1">Inscription</h1>
            <section class="registration-bloc">
                <form method="post" action="" class="form">
                    <label for="" class="label-form">Pseudo :</label><br />
                    <input class="input" type="text" name="pseudo" id="pseudo" value="" placeholder="Entrez votre pseudo" required><br /><br />
                    <label for="" class="label-form">Mot de Passe :</label><br />
                    <input class="input" type="password" name="password" id="password" value="" placeholder="Entrez votre mot de passe" required><br /><br />
                    <button type="submit" name="submit" class="bouton button-next button-next-green">Valider</button>
                    <p class="alert"><?php if (isset($_SESSION['message'])) echo $_SESSION['message'] ?></p>
                </form>
            </section>
            <div class="txt">Déjà inscrit? <a href="./connexion.php" class="link-bold">Se connecter</a></div>
        <?php endif ?>
    </section>
</main>


<?php include '../component/footer.php'; ?>