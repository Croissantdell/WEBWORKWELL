<?php

require_once 'OeuvreBO.php';

class OeuvreDAO {
    private PDO $db;

    public function __construct(PDO $database) {
        $this->db = $database;
    }

    public function getOeuvreById($id): OeuvreBO {
        $sql = "SELECT * FROM OEUVRE WHERE codeOeuvre = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return new OeuvreBO($row['codeOeuvre'], $row['titreOriginalOeuvre'], $row['titreFrancaisOeuvre'], $row['anneeSortieOeuvre'], $row['resumeOeuvre'], $row['nbEpisodeOeuvre'], $row['affiche']);
    }

    public function getLatestOeuvres(int $limit = 3): array {
        $query = "SELECT * FROM OEUVRE ORDER BY anneeSortieOeuvre DESC LIMIT ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createOeuvre(string $titreOriginalOeuvre, string $titreFrancaisOeuvre, int $anneeSortieOeuvre, string $resumeOeuvre, int $nbEpisodeOeuvre, string $affiche): string {
        $sql = "INSERT INTO OEUVRE (titreOriginalOeuvre, titreFrancaisOeuvre, anneeSortieOeuvre, resumeOeuvre, nbEpisodeOeuvre, affiche) VALUES (:titreOriginalOeuvre, :titreFrancaisOeuvre, :anneeSortieOeuvre, :resumeOeuvre, :nbEpisodeOeuvre, :affiche)";
        $stmt = $this->db->prepare($sql);
        $params = [
            'titreOriginalOeuvre' => $titreOriginalOeuvre,
            'titreFrancaisOeuvre' => $titreFrancaisOeuvre,
            'anneeSortieOeuvre' => $anneeSortieOeuvre,
            'resumeOeuvre' => $resumeOeuvre,
            'nbEpisodeOeuvre' => $nbEpisodeOeuvre,
            'affiche' => $affiche,
        ];
        $stmt->execute($params);

        return $this->db->lastInsertId();
    }

    public function deleteOeuvre(int $id) {
        $sql = "DELETE FROM OEUVRE WHERE codeOeuvre = ?";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([$id]);
    }

    public function getAllOeuvres(): array {
        $sql = "SELECT * FROM OEUVRE";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function associerClassification($codeClassification, $codeOeuvre) {
        $sql = "INSERT INTO oeuvre_classification (codeClassification, codeOeuvre) VALUES (:codeClassification, :codeOeuvre)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':codeClassification' => $codeClassification, ':codeOeuvre' => $codeOeuvre]);
    }

    public function associerGenre($idGenre, $codeOeuvre) {
        $sql = "INSERT INTO oeuvre_genre (idGenre, codeOeuvre) VALUES (:idGenre, :codeOeuvre)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':idGenre' => $idGenre, ':codeOeuvre' => $codeOeuvre]);

    }

    public function getAllOeuvresdiff($search = null, $sort = null, $filter = null)
{
    $query = "SELECT * FROM oeuvre";
    $params = [];

    if ($search) {
        $query .= " WHERE titreFrancaisOeuvre LIKE :search";
        $params['search'] = "%$search%";
    }

    if ($filter) {
        $filterQuery = "";
        if ($filter === 'anime') {
            $filterQuery = "SELECT codeOeuvre FROM oeuvre_classification WHERE codeClassification = '02'";
        } elseif ($filter === 'film') {
            $filterQuery = "SELECT codeOeuvre FROM oeuvre_classification WHERE codeClassification = '01'";
        } elseif ($filter === 'serie') {
            $filterQuery = "SELECT codeOeuvre FROM oeuvre_classification WHERE codeClassification = '03'";
        }
        $query .= ($search ? " AND" : " WHERE") . " codeOeuvre IN ($filterQuery)";
    }

    if ($sort && $sort === 'date') {
        $query .= " ORDER BY anneeSortieOeuvre DESC";
    }

    $stmt = $this->db->prepare($query);

    if ($search) {
        $stmt->bindParam(':search', $params['search'], PDO::PARAM_STR);
    }

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
    public function updateOeuvre(string $codeOeuvre, string $titreOriginalOeuvre, string $titreFrancaisOeuvre, int $anneeSortieOeuvre, string $resumeOeuvre, int $nbEpisodeOeuvre, string $affiche)
    {
        $sql = "UPDATE OEUVRE SET titreOriginalOeuvre = :titreOriginalOeuvre, titreFrancaisOeuvre = :titreFrancaisOeuvre, anneeSortieOeuvre = :anneeSortieOeuvre, resumeOeuvre = :resumeOeuvre, nbEpisodeOeuvre = :nbEpisodeOeuvre, affiche = :affiche WHERE codeOeuvre = :codeOeuvre";
        $stmt = $this->db->prepare($sql);
        $params = [
            'codeOeuvre' => $codeOeuvre,
            'titreOriginalOeuvre' => $titreOriginalOeuvre,
            'titreFrancaisOeuvre' => $titreFrancaisOeuvre,
            'anneeSortieOeuvre' => $anneeSortieOeuvre,
            'resumeOeuvre' => $resumeOeuvre,
            'nbEpisodeOeuvre' => $nbEpisodeOeuvre,
            'affiche' => $affiche,
        ];
        return $stmt->execute($params);
    }

}