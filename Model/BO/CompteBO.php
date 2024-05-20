<?php

namespace Model\BO;

class CompteBO {
    private ?int $idCompte;
    private string $login;
    private string $motDePasse;

    public function __construct(?int $idCompte, string $login, string $motDePasse) {
        $this->idCompte = $idCompte;
        $this->login = $login;
        $this->motDePasse = $motDePasse;
    }

    public function getIdCompte(): ?int {
        return $this->idCompte;
    }

    public function getLogin(): string {
        return $this->login;
    }

    public function getMotDePasse(): string {
        return $this->motDePasse;
    }

    public function setIdCompte(?int $idCompte): void {
        $this->idCompte = $idCompte;
    }

    public function setLogin(string $login): void {
        $this->login = $login;
    }

    public function setMotDePasse(string $motDePasse): void {
        $this->motDePasse = $motDePasse;
    }
}
