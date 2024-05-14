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
}
