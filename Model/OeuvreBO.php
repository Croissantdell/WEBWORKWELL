<?php
class OeuvreBO {
    public $codeOeuvre;
    public $titreOriginalOeuvre;
    public $titreFrancaisOeuvre;
    public $anneeSortieOeuvre;
    public $resumeOeuvre;
    public $nbEpisodeOeuvre;
    public $affiche;

    /**
     * @return mixed
     */
    public function getCodeOeuvre()
    {
        return $this->codeOeuvre;
    }

    /**
     * @param mixed $codeOeuvre
     */
    public function setCodeOeuvre($codeOeuvre): void
    {
        $this->codeOeuvre = $codeOeuvre;
    }

    /**
     * @return mixed
     */
    public function getTitreOriginalOeuvre()
    {
        return $this->titreOriginalOeuvre;
    }

    /**
     * @param mixed $titreOriginalOeuvre
     */
    public function setTitreOriginalOeuvre($titreOriginalOeuvre): void
    {
        $this->titreOriginalOeuvre = $titreOriginalOeuvre;
    }

    /**
     * @return mixed
     */
    public function getTitreFrancaisOeuvre()
    {
        return $this->titreFrancaisOeuvre;
    }

    /**
     * @param mixed $titreFrancaisOeuvre
     */
    public function setTitreFrancaisOeuvre($titreFrancaisOeuvre): void
    {
        $this->titreFrancaisOeuvre = $titreFrancaisOeuvre;
    }

    /**
     * @return mixed
     */
    public function getAnneeSortieOeuvre()
    {
        return $this->anneeSortieOeuvre;
    }

    /**
     * @param mixed $anneeSortieOeuvre
     */
    public function setAnneeSortieOeuvre($anneeSortieOeuvre): void
    {
        $this->anneeSortieOeuvre = $anneeSortieOeuvre;
    }

    /**
     * @return mixed
     */
    public function getResumeOeuvre()
    {
        return $this->resumeOeuvre;
    }

    /**
     * @param mixed $resumeOeuvre
     */
    public function setResumeOeuvre($resumeOeuvre): void
    {
        $this->resumeOeuvre = $resumeOeuvre;
    }

    /**
     * @return mixed
     */
    public function getNbEpisodeOeuvre()
    {
        return $this->nbEpisodeOeuvre;
    }

    /**
     * @param mixed $nbEpisodeOeuvre
     */
    public function setNbEpisodeOeuvre($nbEpisodeOeuvre): void
    {
        $this->nbEpisodeOeuvre = $nbEpisodeOeuvre;
    }

    /**
     * @return mixed
     */
    public function getAffiche()
    {
        return $this->affiche;
    }

    /**
     * @param mixed $affiche
     */
    public function setAffiche($affiche): void
    {
        $this->affiche = $affiche;
    }

    public function __construct($code, $titreOrig, $titreFr, $annee, $resume, $nbEp,$image) {
        $this->codeOeuvre = $code;
        $this->titreOriginalOeuvre = $titreOrig;
        $this->titreFrancaisOeuvre = $titreFr;
        $this->anneeSortieOeuvre = $annee;
        $this->resumeOeuvre = $resume;
        $this->nbEpisodeOeuvre = $nbEp;
        $this->affiche=$image;
    }
}
