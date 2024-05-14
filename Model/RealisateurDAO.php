<?php
require_once 'RealisateurBO.php';

class RealisateurDAO
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function getRealisateurByOeuvre($oeuvreId)
    {
        $query = "SELECT realisateur.* 
              FROM realisateur 
              JOIN realiser 
              ON realisateur.idRealisateur = realiser.idRealisateur
              WHERE realiser.codeOeuvre = ?";

        $stmt = $this->db->prepare($query);
        $stmt->execute([$oeuvreId]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getRealisateursByOeuvre($codeOeuvre): array {
    $sql = "SELECT r.* FROM realiser ro JOIN realisateur r ON ro.idRealisateur = r.idRealisateur WHERE ro.codeOeuvre = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([$codeOeuvre]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Assuming fetchAll returns an associative array
}

    public function getAllRealisateurs() {
        $query = "SELECT * FROM REALISATEUR";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function associerOeuvre($idRealisateur, $codeOeuvre) {
        $query = "INSERT INTO realiser (idRealisateur, codeOeuvre) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$idRealisateur, $codeOeuvre]);

        return true;
    }
    public function getRealisateurById($id) {
        $stmt = $this->db->prepare('SELECT * FROM realisateur WHERE idRealisateur = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getOeuvresByRealisateur($id) {
        $stmt = $this->db->prepare('
            SELECT o.* 
            FROM oeuvre o 
            JOIN realiser r ON o.codeOeuvre = r.codeOeuvre 
            WHERE r.idRealisateur = ?
        ');
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function createRealisateur(RealisateurBO $realisateur): bool {
        $sql = "INSERT INTO realisateur (idRealisateur, nomRealisateur, prenomRealisateur, nationaliteRealisateur, recompenseRealisateur, photo) 
                VALUES (:idRealisateur, :nomRealisateur, :prenomRealisateur, :nationaliteRealisateur, :recompenseRealisateur, :photo)";
        $stmt = $this->db->prepare($sql);

        $idRealisateur = $realisateur->getIdRealisateur();
        $nomRealisateur = $realisateur->getNomRealisateur();
        $prenomRealisateur = $realisateur->getPrenomRealisateur();
        $nationaliteRealisateur = $realisateur->getNationaliteRealisateur();
        $recompenseRealisateur = $realisateur->getRecompenseRealisateur();
        $photo = $realisateur->getPhoto();

        $stmt->bindParam(':idRealisateur', $idRealisateur);
        $stmt->bindParam(':nomRealisateur', $nomRealisateur);
        $stmt->bindParam(':prenomRealisateur', $prenomRealisateur);
        $stmt->bindParam(':nationaliteRealisateur', $nationaliteRealisateur);
        $stmt->bindParam(':recompenseRealisateur', $recompenseRealisateur);
        $stmt->bindParam(':photo', $photo);

        return $stmt->execute();
    }
}
