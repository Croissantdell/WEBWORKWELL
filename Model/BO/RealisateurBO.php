<?php

namespace Model\BO;

class RealisateurBO {
    private ?int $idRealisateur;
    private ?string $nomRealisateur;
    private ?string $prenomRealisateur;
    private ?string $nationaliteRealisateur;
    private ?int $recompenseRealisateur;
    private ?string $photo;

    public function __construct(
        ?int $idRealisateur = null,
        ?string $nomRealisateur = null,
        ?string $prenomRealisateur = null,
        ?string $nationaliteRealisateur = null,
        ?int $recompenseRealisateur = null,
        ?string $photo = null
    ) {
        $this->idRealisateur = $idRealisateur;
        $this->nomRealisateur = $nomRealisateur;
        $this->prenomRealisateur = $prenomRealisateur;
        $this->nationaliteRealisateur = $nationaliteRealisateur;
        $this->recompenseRealisateur = $recompenseRealisateur;
        $this->photo = $photo;
    }

    public function getIdRealisateur(): ?int {
        return $this->idRealisateur;
    }

    public function setIdRealisateur(?int $idRealisateur): void {
        $this->idRealisateur = $idRealisateur;
    }

    public function getNomRealisateur(): ?string {
        return $this->nomRealisateur;
    }

    public function setNomRealisateur(?string $nomRealisateur): void {
        $this->nomRealisateur = $nomRealisateur;
    }

    public function getPrenomRealisateur(): ?string {
        return $this->prenomRealisateur;
    }

    public function setPrenomRealisateur(?string $prenomRealisateur): void {
        $this->prenomRealisateur = $prenomRealisateur;
    }

    public function getNationaliteRealisateur(): ?string {
        return $this->nationaliteRealisateur;
    }

    public function setNationaliteRealisateur(?string $nationaliteRealisateur): void {
        $this->nationaliteRealisateur = $nationaliteRealisateur;
    }

    public function getRecompenseRealisateur(): ?int {
        return $this->recompenseRealisateur;
    }

    public function setRecompenseRealisateur(?int $recompenseRealisateur): void {
        $this->recompenseRealisateur = $recompenseRealisateur;
    }

    public function getPhoto(): ?string {
        return $this->photo;
    }

    public function setPhoto(?string $photo): void {
        $this->photo = $photo;
    }
}
