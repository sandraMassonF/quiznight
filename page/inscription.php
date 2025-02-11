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
        $password = password_hash($_POST['password'],PASSWORD_BCRYPT);
        $req = $bdd->prepare("INSERT INTO utilisateur (pseudo, password) VALUES (:pseudo, :password)");
        $req->execute([
            "pseudo" => $pseudo,
            "password" => $password
        ]);
        $req = $req->fetch(PDO::FETCH_ASSOC); 
        echo "Inscription réussie !";

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

<?php include '../component/header.php' ?>

<main class="">
    <section class="">
        <!-- si une session est déjà ouverte on ne propose pas de se reconnecter -->
        <?php if (isset($_SESSION['user'])) : ?>
            <?php header("location:"); ?>
            <!-- si pas de session ouverte on propose de se connecter -->
        <?php else : ?>
            <h1 class="title">Inscription</h1>
            <section class="registration-bloc">
                <form method="post" action="" class="form">
                    <label for="" >Pseudo :</label><br />
                    <input class="input" type="text" name="pseudo" id="pseudo" value="" placeholder="Entrez votre pseudo" required><br /><br />
                    <label for="" >Mot de Passe :</label><br />
                    <input class="input" type="password" name="password" id="password" value="" placeholder="Entrez votre mot de passe" required><br /><br />
                    <!-- <label for="" >Confirmez le Mot de Passe :</label><br />
                    <input class="input" type="password" name="password" id="password" value="" placeholder="Entrez votre mot de passe" required><br /><br /> -->
                    <button type="submit" name="submit" class="bouton">Valider</button>
                </form>                
            </section>
            <div class="txt">Déjà inscrit? <a href="./connexion.php" class="link-bold" >Se connecter</a></div>
        <?php endif ?>
    </section>
</main>
