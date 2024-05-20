<?php

namespace Model\BO;

class JouerBO {
    private ?int $idActeur;
    private ?int $codeOeuvre;
    private ?bool $roleActeur;

    public function __construct(?int $idActeur = null, ?int $codeOeuvre = null, ?bool $roleActeur = null) {
        $this->idActeur = $idActeur;
        $this->codeOeuvre = $codeOeuvre;
        $this->roleActeur = $roleActeur;
    }

    public function getIdActeur(): ?int {
        return $this->idActeur;
    }

    public function setIdActeur(?int $idActeur): void {
        $this->idActeur = $idActeur;
    }

    public function getCodeOeuvre(): ?int {
        return $this->codeOeuvre;
    }

    public function setCodeOeuvre(?int $codeOeuvre): void {
        $this->codeOeuvre = $codeOeuvre;
    }

    public function getRoleActeur(): ?bool {
        return $this->roleActeur;
    }

    public function setRoleActeur(?bool $roleActeur): void {
        $this->roleActeur = $roleActeur;
    }
}
