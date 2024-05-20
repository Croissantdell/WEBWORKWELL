<?php

namespace Model\BO;

class ActeurBO {
    private ?int $idActeur;
    private ?string $nomActeur;
    private ?string $prenomActeur;
    private ?string $nationaliteActeur;
    private ?\DateTime $dateNaissanceActeur;
    private ?string $photo;

    public function __construct(
        ?int $idActeur = null,
        ?string $nomActeur = null,
        ?string $prenomActeur = null,
        ?string $nationaliteActeur = null,
        ?\DateTime $dateNaissanceActeur = null,
        ?string $photo = null
    ) {
        $this->idActeur = $idActeur;
        $this->nomActeur = $nomActeur;
        $this->prenomActeur = $prenomActeur;
        $this->nationaliteActeur = $nationaliteActeur;
        $this->dateNaissanceActeur = $dateNaissanceActeur;
        $this->photo = $photo;
    }

    public function getIdActeur(): ?int {
        return $this->idActeur;
    }

    public function setIdActeur(?int $idActeur): void {
        $this->idActeur = $idActeur;
    }

    public function getNomActeur(): ?string {
        return $this->nomActeur;
    }

    public function setNomActeur(?string $nomActeur): void {
        $this->nomActeur = $nomActeur;
    }

    public function getPrenomActeur(): ?string {
        return $this->prenomActeur;
    }

    public function setPrenomActeur(?string $prenomActeur): void {
        $this->prenomActeur = $prenomActeur;
    }

    public function getNationaliteActeur(): ?string {
        return $this->nationaliteActeur;
    }

    public function setNationaliteActeur(?string $nationaliteActeur): void {
        $this->nationaliteActeur = $nationaliteActeur;
    }

    public function getDateNaissanceActeur(): ?\DateTime {
        return $this->dateNaissanceActeur;
    }

    public function setDateNaissanceActeur(?\DateTime $dateNaissanceActeur): void {
        $this->dateNaissanceActeur = $dateNaissanceActeur;
    }

    public function getPhoto(): ?string {
        return $this->photo;
    }

    public function setPhoto(?string $photo): void {
        $this->photo = $photo;
    }
}
