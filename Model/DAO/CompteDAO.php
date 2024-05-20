<?php

namespace Model\DAO;

use Model\BO\CompteBO;
use \PDO;

class CompteDAO {
    private $bdd;

    public function __construct(PDO $bdd) {
        $this->bdd = $bdd;
    }

    public function createCompte(CompteBO $compte) {
        $query = "INSERT INTO compte (login, motDePasse) VALUES (:login, :motDePasse)";
        $stmt = $this->bdd->prepare($query);
        return $stmt->execute([
            ':login' => $compte->getLogin(),
            ':motDePasse' => $compte->getMotDePasse()
        ]);
    }

    public function findByLogin($login) {
        $query = "SELECT * FROM compte WHERE login = :login";
        $stmt = $this->bdd->prepare($query);
        $stmt->execute([':login' => $login]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new CompteBO((int)$row['idCompte'], $row['login'], $row['motDePasse']) : null;
    }
}
