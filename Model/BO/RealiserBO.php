<?php

namespace Model\BO;

class RealiserBO {
    private ?int $idRealisateur;
    private ?int $codeOeuvre;

    public function __construct(?int $idRealisateur = null, ?int $codeOeuvre = null) {
        $this->idRealisateur = $idRealisateur;
        $this->codeOeuvre = $codeOeuvre;
    }

    public function getIdRealisateur(): ?int {
        return $this->idRealisateur;
    }

    public function setIdRealisateur(?int $idRealisateur): void {
        $this->idRealisateur = $idRealisateur;
    }

    public function getCodeOeuvre(): ?int {
        return $this->codeOeuvre;
    }

    public function setCodeOeuvre(?int $codeOeuvre): void {
        $this->codeOeuvre = $codeOeuvre;
    }
}
