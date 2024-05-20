<?php

namespace Model\BO;

class GenreBO {
    private ?int $idGenre;
    private ?string $libelleGenre;

    public function __construct(?int $idGenre = null, ?string $libelleGenre = null) {
        $this->idGenre = $idGenre;
        $this->libelleGenre = $libelleGenre;
    }

    public function getIdGenre(): ?int {
        return $this->idGenre;
    }

    public function setIdGenre(?int $idGenre): void {
        $this->idGenre = $idGenre;
    }

    public function getLibelleGenre(): ?string {
        return $this->libelleGenre;
    }

    public function setLibelleGenre(?string $libelleGenre): void {
        $this->libelleGenre = $libelleGenre;
    }
}
