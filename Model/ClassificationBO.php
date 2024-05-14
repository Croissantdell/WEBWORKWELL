<?php
class ClassificationBO {
    private $codeClassification;
    private $libelleClassification;

    public function __construct($codeClassification, $libelleClassification) {
        $this->codeClassification = $codeClassification;
        $this->libelleClassification = $libelleClassification;
    }

    public function getCodeClassification() {
        return $this->codeClassification;
    }

    public function getLibelleClassification() {
        return $this->libelleClassification;
    }

    public function setCodeClassification($codeClassification) {
        $this->codeClassification = $codeClassification;
    }

    public function setLibelleClassification($libelleClassification) {
        $this->libelleClassification = $libelleClassification;
    }
}