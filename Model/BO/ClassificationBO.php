<?php

namespace Model\BO;

class ClassificationBO {
    private ?int $codeClassification;
    private ?string $libelleClassification;

    public function __construct(?int $codeClassification = null, ?string $libelleClassification = null) {
        $this->codeClassification = $codeClassification;
        $this->libelleClassification = $libelleClassification;
    }

    public function getCodeClassification(): ?int {
        return $this->codeClassification;
    }

    public function setCodeClassification(?int $codeClassification): void {
        $this->codeClassification = $codeClassification;
    }

    public function getLibelleClassification(): ?string {
        return $this->libelleClassification;
    }

    public function setLibelleClassification(?string $libelleClassification): void {
        $this->libelleClassification = $libelleClassification;
    }
}
