<?php
include_once(__DIR__ . "/ConnexionBdd.php");
class Image extends ConnexionBdd
{

    public function __construct()
    {
        parent::__construct($this->bdd);
    }

    // créer image
    public function createImage($nom, $taille, $type, $tmp_name, $id_quiz)
    {
        // Déplacer le fichier téléchargé vers un répertoire permanent
        $target_dir = "../asset/img/quiz/";
        $target_file = $target_dir . basename($nom);
        if (move_uploaded_file($tmp_name, $target_file)) {
            $sql = "INSERT INTO image(nom, taille, type, bin, id_quiz) VALUES (:nom, :taille, :type, :bin, :id_quiz)";
            $create = $this->bdd->prepare($sql);
            $create->execute([
                ':nom' => $nom,
                ':taille' => intval($taille),
                ':type' => $type,
                ':bin' => $target_file,
                ':id_quiz' => intval($id_quiz)
            ]);
        }
    }

    // modifier image
    public function updateImage($id_image, $nom, $taille, $type, $tmp_name, $id_quiz)
    {
        $target_dir = "../asset/img/quiz/";
        $target_file = $target_dir . basename($nom);
        if (move_uploaded_file($tmp_name, $target_file)) {
            $sql = "UPDATE image SET nom = :nom, taille =:taille, type =:type, bin =:bin, id_quiz=:id_quiz WHERE id = :id";
            $create = $this->bdd->prepare($sql);
            $create->execute([
                ':id' => $id_image,
                ':nom' => $nom,
                ':taille' => intval($taille),
                ':type' => intval($type),
                ':bin' => $target_file,
                ':id_quiz' => intval($id_quiz)
            ]);
        }
    }
    // récupération image par id du Quiz
    public function getImageById($id)
    {
        $sql = "SELECT * FROM image WHERE id_quiz = $id";
        $recupImg = $this->bdd->prepare($sql);
        $recupImg->execute();
        return $recupImg->fetchAll();
    }
}
