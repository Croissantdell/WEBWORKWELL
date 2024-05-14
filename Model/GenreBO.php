<?php
class GenreBO
{
    private $idGenre;
    private $libelleGenre;

    public function __construct($idGenre, $libelleGenre)
    {
        $this->idGenre = $idGenre;
        $this->libelleGenre = $libelleGenre;
    }

    public function getIdGenre()
    {
        return $this->idGenre;
    }

    public function getLibelleGenre()
    {
        return $this->libelleGenre;
    }

    public function setIdGenre($idGenre)
    {
        $this->idGenre = $idGenre;
    }

    public function setLibelleGenre($libelleGenre)
    {
        $this->libelleGenre = $libelleGenre;
    }
}