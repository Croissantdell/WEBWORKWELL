<?php

namespace Model\BO;

class OeuvreBO {
    private ?int $codeOeuvre;
    private ?string $titreOriginalOeuvre;
    private ?string $titreFrancaisOeuvre;
    private ?int $anneeSortieOeuvre;
    private ?string $resumeOeuvre;
    private ?int $nbEpisodeOeuvre;
    private ?string $affiche;
    private ?int $codeClassification;
    private ?int $idGenre;

    public function __construct(
        ?int $codeOeuvre = null,
        ?string $titreOriginalOeuvre = null,
        ?string $titreFrancaisOeuvre = null,
        ?int $anneeSortieOeuvre = null,
        ?string $resumeOeuvre = null,
        ?int $nbEpisodeOeuvre = null,
        ?string $affiche = null,
        ?int $codeClassification = null,
        ?int $idGenre = null
    ) {
        $this->codeOeuvre = $codeOeuvre;
        $this->titreOriginalOeuvre = $titreOriginalOeuvre;
        $this->titreFrancaisOeuvre = $titreFrancaisOeuvre;
        $this->anneeSortieOeuvre = $anneeSortieOeuvre;
        $this->resumeOeuvre = $resumeOeuvre;
        $this->nbEpisodeOeuvre = $nbEpisodeOeuvre;
        $this->affiche = $affiche;
        $this->codeClassification = $codeClassification;
        $this->idGenre = $idGenre;
    }

    public function getCodeOeuvre(): ?int {
        return $this->codeOeuvre;
    }

    public function setCodeOeuvre(?int $codeOeuvre): void {
        $this->codeOeuvre = $codeOeuvre;
    }

    public function getTitreOriginalOeuvre(): ?string {
        return $this->titreOriginalOeuvre;
    }

    public function setTitreOriginalOeuvre(?string $titreOriginalOeuvre): void {
        $this->titreOriginalOeuvre = $titreOriginalOeuvre;
    }

    public function getTitreFrancaisOeuvre(): ?string {
        return $this->titreFrancaisOeuvre;
    }

    public function setTitreFrancaisOeuvre(?string $titreFrancaisOeuvre): void {
        $this->titreFrancaisOeuvre = $titreFrancaisOeuvre;
    }

    public function getAnneeSortieOeuvre(): ?int {
        return $this->anneeSortieOeuvre;
    }

    public function setAnneeSortieOeuvre(?int $anneeSortieOeuvre): void {
        $this->anneeSortieOeuvre = $anneeSortieOeuvre;
    }

    public function getResumeOeuvre(): ?string {
        return $this->resumeOeuvre;
    }

    public function setResumeOeuvre(?string $resumeOeuvre): void {
        $this->resumeOeuvre = $resumeOeuvre;
    }

    public function getNbEpisodeOeuvre(): ?int {
        return $this->nbEpisodeOeuvre;
    }

    public function setNbEpisodeOeuvre(?int $nbEpisodeOeuvre): void {
        $this->nbEpisodeOeuvre = $nbEpisodeOeuvre;
    }

    public function getAffiche(): ?string {
        return $this->affiche;
    }

    public function setAffiche(?string $affiche): void {
        $this->affiche = $affiche;
    }

    public function getCodeClassification(): ?int {
        return $this->codeClassification;
    }

    public function setCodeClassification(?int $codeClassification): void {
        $this->codeClassification = $codeClassification;
    }

    public function getIdGenre(): ?int {
        return $this->idGenre;
    }

    public function setIdGenre(?int $idGenre): void {
        $this->idGenre = $idGenre;
    }
}
