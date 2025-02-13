<?php
include 'Class.Bdd.php';

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
                    $_SESSION['user'] = $req['id'];
                    $_SESSION['score'] = $req['score'];
                    header("location:./index.php");
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
                    $req = $bdd->prepare("INSERT INTO utilisateur (pseudo, password) VALUES (:pseudo, :password)");
                    $req->execute([
                        "pseudo" => $pseudo,
                        "password" => $password
                    ]);
                    $req = $req->fetch(PDO::FETCH_ASSOC);

                    echo '<p class="">"Inscription réussie !"</p>';

                    $_SESSION['user'] = $req;

                    header("location:../index.php");
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
            } else {
                $score = $newScore;
            }

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
}
