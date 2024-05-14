<?php
require_once 'ActeurBO.php';

class ActeurDAO {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function getActorsByOeuvre($oeuvreId) {
        $query = "SELECT acteur.* ,jouer.roleActeur 
                  FROM acteur 
                  JOIN jouer 
                  ON acteur.idActeur = jouer.idActeur
                  WHERE jouer.codeOeuvre = ?";

        $stmt = $this->db->prepare($query);
        $stmt->execute([$oeuvreId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllActeurs() {
        $query = "SELECT * FROM ACTEUR";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function associerOeuvre($idActeur, $codeOeuvre, $isMainActor) {
        $query = "INSERT INTO jouer (idActeur, codeOeuvre, roleActeur) VALUES (?, ?, ?)";

        $stmt = $this->db->prepare($query);
        $stmt->execute([$idActeur, $codeOeuvre, $isMainActor]);

        return true;
    }

    public function getActorById($id) {
        $sql = "SELECT * FROM ACTEUR WHERE idActeur = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getOeuvresByActor($id) {
        $sql = "SELECT OEUVRE.*,jouer.roleActeur
            FROM OEUVRE 
            JOIN jouer ON OEUVRE.codeOeuvre = jouer.codeOeuvre 
            WHERE jouer.idActeur = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}