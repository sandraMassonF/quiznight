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

if (isset($_POST['submit'])) {
    if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
        $pseudo = htmlentities($_POST['pseudo']);
        $password = htmlentities($_POST['password']);
        $req = $bdd->prepare("SELECT * FROM utilisateur WHERE pseudo = :pseudo AND password = :password");
        $req->execute([
            "pseudo" => $pseudo,
            "password" => $password
        ]);
        $req = $req->fetch(PDO::FETCH_ASSOC);

        if (empty($req)) {
            echo '<p class="alert">Pseudo ou mot de passe incorrect !</p>';
        } else {
            session_start();
            $_SESSION['user'] = $req;
            header("location:");
        }
    } else {
        echo '<p class="alert">Veuillez remplir tous les champs</p>';
    }
}

?>

<main class="">
    <section class="">
        <!-- si une session est déjà ouverte on ne propose pas de se reconnecter -->
        <?php if (isset($_SESSION['user'])) : ?>
            <?php header("location:gestionPlat.php"); ?>
            <!-- si pas de session ouverte on propose de se connecter -->
        <?php else : ?>
            <h1 class="titre">Connexion</h1>
            <section class="bloc">
                <form method="post" action="" class="form">
                    <label for="" >Pseudo :</label><br />
                    <input class="input" type="text" name="pseudo" id="pseudo" value="" placeholder="Entrez votre pseudo" required><br /><br />
                    <label for="" >Mot de Passe :</label><br />
                    <input class="input" type="password" name="password" id="password" value="" placeholder="Entrez votre mot de passe" required><br /><br />
                    <button type="submit" name="submit" class="bouton">Valider</button>
                </form>
            </section>
        <?php endif ?>
    </section>
</main>
