<?php


class Utilisateur{

private $pseudo;
private $password;
private $score;


public function __construct(string $pseudo, string $password, int $score) {

    $this->pseudo = $pseudo;
    $this->password = $password;
    $this->score = $score;
}

public function getPseudo()
{
return $this->pseudo;
}
 
public function setPseudo($pseudo)
{
return $this->pseudo = $pseudo;
}

public function getPassword()
{
return $this->password;
}

public function setPassword($password)
{
return $this->password = $password;
}
public function getScore()
{
return $this->score;
}

public function setScore($score)
{
return $this->score = $score;
}



}