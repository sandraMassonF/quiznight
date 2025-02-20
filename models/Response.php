<?php
include_once(__DIR__ . "/ConnexionBdd.php");
class Response extends ConnexionBdd
{
  public function __construct()
  {
    parent::__construct($this->bdd);
  }

  public function createResponse($reponse, $resultat, $id_question)
  {

    $sql = "INSERT INTO reponse (reponse, resultat,id_question) VALUES (:reponse,:resultat, :id_question)";
    $create = $this->bdd->prepare($sql);
    $create->execute([
      ':reponse' => $reponse,
      ':resultat' => intval($resultat),
      ':id_question' => intval($id_question),
    ]);
  }

  public function updateResponse($id_reponse, $reponse, $resultat, $id_question)
  {

    $sql = "UPDATE reponse SET reponse = :reponse, resultat= :resultat, id_question= :id_question  WHERE id = :id";
    $update = $this->bdd->prepare($sql);
    $update->execute([
      ':id' => $id_reponse,
      ':reponse' => $reponse,
      ':resultat' => intval($resultat),
      ':id_question' => intval($id_question)
    ]);
  }
}
