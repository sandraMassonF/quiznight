<?php
include_once('Class.Bdd.php');

class Utilisateur
{

    private $id;
    private $pseudo;
    private $password;
    private $score;


    public function __construct()
    {

        $this->id;
        $this->pseudo;
        $this->password;
        $this->score;
    }

    public function connexion()
    {
        $connexion = new ConnexionBdd();
        $bdd = $connexion->Connexion();
        if (isset($_POST['submit'])) {
            if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
                $pseudo = htmlentities($_POST['pseudo']);
                $password = $_POST['password'];

                $req = $bdd->prepare("SELECT * FROM utilisateur WHERE pseudo = :pseudo");
                $req->execute(["pseudo" => $pseudo]);
                $user = $req->fetch(PDO::FETCH_ASSOC);
              
                if (!$user) { // Vérifie si l'utilisateur existe
                    echo '<p class="alert">Pseudo incorrect ou inconnu !</p>';
                    } elseif($user['score'] <= 0){
                        echo '<p class="alert">Vous ne pouvez plus vous connecter car vous êtes mort</p>';                        
                    }
                    else{
                    if (password_verify($password, $user['password']) ||  $_SESSION['user'] = $user['id']) {
                        session_start();
                        $_SESSION['user'] = $user['id'];
                        $_SESSION['score'] = $user['score'];
                        header("location: ../index.php");
                        exit(); // Ajout d'un exit() après la redirection
                    } else {
                        echo '<p class="alert">Mot de passe incorrect !</p>';
                    }

                }
            } else {
                echo '<p class="alert">Veuillez remplir tous les champs</p>';
            }
        }
    }


    public function inscription()
    {
        $connexion = new ConnexionBdd();
        $bdd = $connexion->Connexion();
        if (isset($_POST['submit'])) {
            if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
                $pseudo = htmlentities($_POST['pseudo']);
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $checkPseudo = $bdd->prepare("SELECT id FROM utilisateur WHERE pseudo = :pseudo");
                $checkPseudo->execute(["pseudo" => $pseudo]);

                if ($checkPseudo->fetch()) {
                    echo '<p class="alert"> Ce pseudo est déjà utilisé !</p>';
                } else {

                    $req = $bdd->prepare("INSERT INTO utilisateur (pseudo, password, score) VALUES (:pseudo, :password, :score)");
                    $req->execute([
                        "pseudo" => $pseudo,
                        "password" => $password,
                        "score" => 10

                    ]);
                    $req = $req->fetch(PDO::FETCH_ASSOC);

                    echo '<p class="">"Inscription réussie !"</p>';

                    $_SESSION['user'] = $req;

                    header("location:connexion.php");

                }
            } else {
                echo '<p class="alert">Veuillez remplir tous les champs</p>';
            }

        }
    }

    // calcul et update score utilisateur
    public function updateScore($idUser, $score, $wrongAnswers)
    {
        if ($wrongAnswers > 0) {
            $newScore = $score - $wrongAnswers;
            if ($newScore < 0) {
                $newScore = 0;
            }

            $score = $newScore;

            $newBdd = new ConnexionBdd();
            $bdd = $newBdd->connexion();
            $newScoreStmt = $bdd->prepare("UPDATE utilisateur SET score = :score
            WHERE utilisateur.id = :idUser;
            ");
            $newScoreStmt->execute([
                ':score' => $newScore,
                ':idUser' => $idUser
            ]);
        }

        return $score;

    }

    //récupère toutes les infos utilisateurs (sauf mot de passe)
    public function get_userInfo()
    {
        $newBdd = new ConnexionBdd();
        $bdd = $newBdd->connexion();
        $usersInfoStmt = $bdd->prepare("SELECT utilisateur.id, utilisateur.pseudo, utilisateur.score
        FROM utilisateur
        ORDER BY score ASC;
            ");
        $usersInfoStmt->execute();
        return $usersInfoStmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_userEliminated()
    {
        $newBdd = new ConnexionBdd();
        $bdd = $newBdd->connexion();
        $usersElimStmt = $bdd->prepare("SELECT utilisateur.id, utilisateur.pseudo, utilisateur.score
        FROM utilisateur
        WHERE utilisateur.score = 0;
            ");
        $usersElimStmt->execute();
        return $usersElimStmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
