<?php
class CompteBO {
    private $idCompte;
    private $login;
    private $motDePasse;

    public function __construct($idCompte, $login, $motDePasse) {
        $this->idCompte = $idCompte;
        $this->login = $login;
        $this->motDePasse = $motDePasse;
    }

    public function getIdCompte() {
        return $this->idCompte;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getMotDePasse() {
        return $this->motDePasse;
    }

    public function setIdCompte($idCompte) {
        $this->idCompte = $idCompte;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function setMotDePasse($motDePasse) {
        $this->motDePasse = $motDePasse;
    }
}