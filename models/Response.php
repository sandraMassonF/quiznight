<?php
include_once(__DIR__ . "/Class.Bdd.php");
class Response
{

  public function createResponse($reponse, $resultat, $id_question)
  {
    $newBdd = new ConnexionBdd();
    $bdd = $newBdd->connexion();
    $sql = "INSERT INTO reponse (reponse, resultat,id_question) VALUES (:reponse,:resultat, :id_question)";
    $create = $bdd->prepare($sql);
    $create->execute([
      ':reponse' => $reponse,
      ':resultat' => intval($resultat),
      ':id_question' => $id_question,
    ]);
  }

  public function updateResponse($id_response, $response, $resultat, $id_question)
  {
    $newBdd = new ConnexionBdd();
    $bdd = $newBdd->connexion();
    $sql = "UPDATE response SET response = :response, resultat= :resultat, id_question= :id_question  WHERE id = :id";
    $update = $bdd->prepare($sql);
    $update->execute([
      ':response' => $response,
      ':resultat' => $resultat,
      ':id_question' => $id_question,
      ':id' => $id_response
    ]);
  }
}
