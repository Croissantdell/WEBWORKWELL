<?php
class RealisateurBO {
    private $idRealisateur;
    private $nomRealisateur;
    private $prenomRealisateur;
    private $nationaliteRealisateur;
    private $recompenseRealisateur;
    private $photo;

    public function __construct($idRealisateur, $nomRealisateur, $prenomRealisateur, $nationaliteRealisateur, $recompenseRealisateur, $photo) {
        $this->idRealisateur = $idRealisateur;
        $this->nomRealisateur = $nomRealisateur;
        $this->prenomRealisateur = $prenomRealisateur;
        $this->nationaliteRealisateur = $nationaliteRealisateur;
        $this->recompenseRealisateur = $recompenseRealisateur;
        $this->photo = $photo;
    }

    public function getIdRealisateur() {
        return $this->idRealisateur;
    }

    public function getNomRealisateur() {
        return $this->nomRealisateur;
    }

    public function getPrenomRealisateur() {
        return $this->prenomRealisateur;
    }

    public function getNationaliteRealisateur() {
        return $this->nationaliteRealisateur;
    }

    public function getRecompenseRealisateur() {
        return $this->recompenseRealisateur;
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function setIdRealisateur($idRealisateur) {
        $this->idRealisateur = $idRealisateur;
    }

    public function setNomRealisateur($nomRealisateur) {
        $this->nomRealisateur = $nomRealisateur;
    }

    public function setPrenomRealisateur($prenomRealisateur) {
        $this->prenomRealisateur = $prenomRealisateur;
    }

    public function setNationaliteRealisateur($nationaliteRealisateur) {
        $this->nationaliteRealisateur = $nationaliteRealisateur;
    }

    public function setRecompenseRealisateur($recompenseRealisateur) {
        $this->recompenseRealisateur = $recompenseRealisateur;
    }

    public function setPhoto($photo) {
        $this->photo = $photo;
    }
}
?>
