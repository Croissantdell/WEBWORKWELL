<?php
class ActeurBO {
    private $idActeur;
    private $nomActeur;
    private $prenomActeur;
    private $nationaliteActeur;
    private $dateNaissanceActeur;
    private $photo;

    public function __construct($idActeur, $nomActeur, $prenomActeur, $nationaliteActeur, $dateNaissanceActeur, $photo) {
        $this->idActeur = $idActeur;
        $this->nomActeur = $nomActeur;
        $this->prenomActeur = $prenomActeur;
        $this->nationaliteActeur = $nationaliteActeur;
        $this->dateNaissanceActeur = $dateNaissanceActeur;
        $this->photo = $photo;

    }


    public function getIdActeur() {
        return $this->idActeur;
    }

    public function getNomActeur() {
        return $this->nomActeur;
    }

    public function getPrenomActeur() {
        return $this->prenomActeur;
    }

    public function getNationaliteActeur() {
        return $this->nationaliteActeur;
    }

    public function getDateNaissanceActeur() {
        return $this->dateNaissanceActeur;
    }

    public function setIdActeur($idActeur) {
        $this->idActeur = $idActeur;
    }

    public function setNomActeur($nomActeur) {
        $this->nomActeur = $nomActeur;
    }

    public function setPrenomActeur($prenomActeur) {
        $this->prenomActeur = $prenomActeur;
    }

    public function setNationaliteActeur($nationaliteActeur) {
        $this->nationaliteActeur = $nationaliteActeur;
    }

    public function setDateNaissanceActeur($dateNaissanceActeur) {
        $this->dateNaissanceActeur = $dateNaissanceActeur;
    }
     public function getPhoto() {
        return $this->photo;
    }

    public function setPhoto($photo) {
        $this->photo = $photo;
    }

}