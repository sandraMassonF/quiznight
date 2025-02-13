<?php
include_once(__DIR__ . "/Class.Bdd.php");
class Image
{
    public function createImage($nom, $taille, $type, $bin, $id_quiz)
    {
        $newBdd = new ConnexionBdd();
        $bdd = $newBdd->connexion();
        $sql = "INSERT INTO reponse (reponse, resultat,id_question) VALUES (:reponse,:resultat, :id_question)";
        $create = $bdd->prepare($sql);
        $create->execute([
            ':reponse' => $reponse,
            ':resultat' => intval($resultat),
            ':id_question' => intval($id_question),
        ]);
    }
    public function updateResponse($id_reponse, $reponse, $resultat, $id_question)
    {
        $newBdd = new ConnexionBdd();
        $bdd = $newBdd->connexion();
        $sql = "UPDATE reponse SET reponse = :reponse, resultat= :resultat, id_question= :id_question  WHERE id = :id";
        $update = $bdd->prepare($sql);
        $update->execute([
            ':id' => $id_reponse,
            ':reponse' => $reponse,
            ':resultat' => intval($resultat),
            ':id_question' => intval($id_question)
        ]);
    }
}
