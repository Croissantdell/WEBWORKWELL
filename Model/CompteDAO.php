<?php
class CompteDAO {
private $db;

public function __construct($database) {
$this->db = $database;
}

public function getCompteById($id) {
$sql = "SELECT * FROM COMPTE WHERE idCompte = ?";
$stmt = $this->db->prepare($sql);
$stmt->execute([$id]);
$row = $stmt->fetch();
return new Compte($row['idCompte'], $row['login'], $row['motDePasse']);
}
}
